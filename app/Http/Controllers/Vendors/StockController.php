<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Http\Requests\StockRequest;
use App\Repositories\StockRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    protected $stockRepository;
    protected $productRepository;

    public function __construct(StockRepositoryInterface $stockRepository, ProductRepositoryInterface $productRepository)
    {
        $this->stockRepository = $stockRepository;
        $this->productRepository = $productRepository;
    }

    // List all stocks for the vendor
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $stocks = Stock::whereHas('product', function ($query) {
                $query->where('vendor_id', auth()->id());
            })->with('product','product.vendor');

            return DataTables::of($stocks)
                ->addColumn('action', function ($stock) {
                    return '<a href="' . route('vendor.stock.edit', $stock->id) . '" class="btn btn-sm btn-primary">Edit</a>
                            <form action="' . route('vendor.stock.destroy', $stock->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>';
                })
                ->editColumn('product_price', function($row) {
                    return '$' . number_format($row->product->price, 2);
                })
                ->editColumn('name', function($row) {
                    return $row->product->name;
                })
                ->editColumn('total_quantity', function($row) {
                    return $row->total_quantity ?? '0.00';
                })
                ->editColumn('balance_quantity', function($row) {
                    return $row->balance_quantity ?? $row->total_quantity;
                })
                ->editColumn('total_quantity_price', function($row) {
                    // Ensure product price and total quantity exist before calculation
                    $price = isset($row->product->price) && isset($row->total_quantity) 
                        ? $row->product->price * $row->total_quantity 
                        : 0;
                    return '$' . number_format($price, 2);
                })
                ->editColumn('balance_quantity_price', function($row) {
                    // Ensure product price and balance quantity exist before calculation
                    $quantity = $row->balance_quantity ?? $row->total_quantity;
                    $price = isset($row->product->price) && isset($quantity) 
                        ? $row->product->price * $quantity 
                        : 0;
                    return '$' . number_format($price, 2);
                })
                ->editColumn('vendor', function($row) {
                    return $row->product->vendor->name ?? 'N/A'; // Check if vendor exists
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('vendors.stock.index');
    }

    public function create()
    {
        $products = $this->productRepository->getByVendor(auth()->id());
        return view('vendors.stock.create', ['products' => $products]);
    }

    public function store(StockRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $this->stockRepository->create($data);
            DB::commit();

            return redirect()->route('vendor.stock.index')->with('success', 'Stock created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('vendor.stock.index')->with('error', 'Error creating stock: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $stock = $this->stockRepository->findByVendor($id, auth()->id());
        $products = $this->productRepository->getByVendor(auth()->id());

        return view('vendors.stock.edit', compact('stock', 'products'));
    }

    public function update(StockRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $this->stockRepository->updateByVendor($id, $request->validated(), auth()->id());
            DB::commit();

            return redirect()->route('vendor.stock.index')->with('success', 'Stock updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('vendor.stock.index')->with('error', 'Error updating stock: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $this->stockRepository->deleteByVendor($id, auth()->id());
            DB::commit();

            return redirect()->route('vendor.stock.index')->with('success', 'Stock deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('vendor.stock.index')->with('error', 'Error deleting stock: ' . $e->getMessage());
        }
    }
}
