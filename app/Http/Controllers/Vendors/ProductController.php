<?php
namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;


use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productRepository;
    protected $userRepository;


    public function __construct(ProductRepositoryInterface $productRepository, UserRepositoryInterface $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;

    }

    // List all products for the vendor
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::where('vendor_id', auth()->id())->with('vendor')->select('products.*');

            return DataTables::of($products)
               
                ->addColumn('action', function ($product) {
                    return '<a href="' . route('vendor.product.edit', $product->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <form action="' . route('vendor.product.destroy', $product->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>';
                })
                ->rawColumns(['action']) 
                ->make(true);
        }

        return view('vendors.products.index');
    }

    public function create()
    {
        $vendorId = auth()->id();
        $vendor = $this->userRepository->find($vendorId); 
        return view('vendors.products.create',['vendor'=>$vendor]);
    }

    // Store a new product for the vendor
    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['vendor_id'] = auth()->id();
            
            $this->productRepository->create($data);
            DB::commit();
            return redirect()->route('vendor.product.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('vendor.product.index')->with('error', 'Error creating product: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $product = $this->productRepository->findByVendor($id, auth()->id());
        $vendorId = auth()->id();
        $vendor = $this->userRepository->find($vendorId); 
        return view('vendors.products.edit', compact('product','vendor'));
    }

    // Update the product
    public function update(ProductRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $product = $this->productRepository->findByVendor($id, auth()->id());
            
            $this->productRepository->update($id, $request->validated());
            DB::commit();
            return redirect()->route('vendor.product.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('vendor.product.index')->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    // Delete the product
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $this->productRepository->deleteByVendor($id, auth()->id());
            DB::commit();
            return redirect()->route('vendor.product.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('vendor.product.index')->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }
}
