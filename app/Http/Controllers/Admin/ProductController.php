<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    protected $productRepository;
    protected $userRepository;

    public function __construct(ProductRepositoryInterface $productRepository, UserRepositoryInterface $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('vendor')->select('products.*');

            return DataTables::of($products)
                ->addColumn('vendor_name', function ($product) {
                    return $product->vendor->name ?? 'N/A';  // Handle if vendor is null
                })
                ->addColumn('image', function ($product) {
                    if ($product->image) {
                        $imageUrl = asset('storage/' . $product->image);
                        return '<img src="' . $imageUrl . '" alt="Product Image" width="50" height="50">';
                    }else{
                        return '';
                    }
                })
                ->addColumn('action', function ($product) {
                    return '<a href="' . route('product.edit', $product->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <form action="' . route('product.destroy', $product->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>';
                })
                ->rawColumns(['action','image'])  // Allow HTML in action column
                ->make(true);
        }

        return view('product.index');
    }

    public function create()
    {
        $vendors = $this->userRepository->all();
        return view('product.create', compact('vendors'));
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = $this->productRepository->create($request->validated());
            DB::commit();
            return redirect()->route('product.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('product.index')->with('error', 'Error creating product: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $product = $this->productRepository->find($id);
        $vendors = $this->userRepository->all();
        return view('product.edit', compact('product', 'vendors'));
    }

    public function update(ProductRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $product = $this->productRepository->find($id);
            $this->productRepository->update($id, $request->validated());
            DB::commit();
            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('product.index')->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $this->productRepository->delete($id);
            DB::commit();
            return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('product.index')->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }
}
