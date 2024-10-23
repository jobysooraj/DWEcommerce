<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\VendorRepositoryInterface;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $productRepository;
    protected $vendorRepository;

    public function __construct(ProductRepositoryInterface $productRepository,VendorRepositoryInterface $vendorRepository)
    {
        $this->productRepository = $productRepository;
        $this->vendorRepository = $vendorRepository;
    }
 
    public function index(Request $request)    {
        if ($request->ajax()) {
            $products = Product::with('vendor')->select('products.*'); // Assuming 'vendor' is a relationship

            return DataTables::of($products)
                ->addColumn('action', function ($product) {
                    return '<a href="'.route('product.edit', $product->id).'" class="btn btn-sm btn-primary">Edit</a>
                            <form action="'.route('product.destroy', $product->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>';
                })
                ->make(true);
        }

    
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = $this->vendorRepository->all();
        return view('product.create',compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        dd("ghfgdfddfd");
        $product = $this->productRepository->create($request->validated());
        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
