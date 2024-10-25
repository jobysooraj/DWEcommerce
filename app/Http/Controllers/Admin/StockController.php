<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Http\Requests\StockRequest;
use App\Repositories\StockRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    protected $stockRepository;
    protected $productRepository;
    protected $userRepository;

    public function __construct(StockRepositoryInterface $stockRepository, ProductRepositoryInterface $productRepository,UserRepositoryInterface $userRepository)
    {
        $this->stockRepository = $stockRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $stocks = Stock::with(['product', 'vendor'])->get();

            return DataTables::of($stocks)
                ->addColumn('action', function($row) {
                    return '<a href="'.route('stock.edit', $row->id).'" class="btn btn-sm btn-primary">Edit</a>
                            <form action="'.route('stock.destroy', $row->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>';
                })
                ->editColumn('product_price', function($row) {
                    return '$' . number_format($row->product->price, 2);
                })
                ->editColumn('name', function($row) {
                    return $row->product->name;
                })
                ->editColumn('vendor', function($row) {
                    return $row->vendor->name ?? '';
                })
                ->editColumn('total_quantity', function($row) {
                    return $row->total_quantity ?? '0.00';
                })
                ->editColumn('balance_quantity', function($row) {
                    return $row->balance_quantity ?? $row->total_quantity;
                })
                ->editColumn('total_quantity_price', function($row) {
                    $price = $row->product->price * $row->total_quantity;
                    return $price ?? '0.00';
                })
                ->editColumn('balance_quantity_price', function($row) {
                    $price = $row->product->price * ($row->balance_quantity ?? $row->total_quantity);
                    return $price ?? '0.00';
                })
                ->editColumn('vendor', function($row) {
                    return $row->product->vendor->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('stock.index'); 
    }

    public function create()
    {
        $products = $this->productRepository->all();
        $vendors = $this->userRepository->all();
        return view('stock.create', ['products' => $products,'vendors'=>$vendors]);
    }

    public function store(StockRequest $request)
    {

        try {
            DB::beginTransaction();
    
            $product = $this->productRepository->find($request->product_id);
            $userId = $product->user_id;
            $existingStock = $this->stockRepository->findByProductAndVendor($request->product_id,$product->user_id);
           
            if ($existingStock) {    
                $total_quantity =$existingStock->total_quantity+ $request->total_quantity;
              
                // $existingStock->balance_quantity += $request->total_quantity;
                $stockData = array_merge($request->validated(), ['user_id' => $userId,'total_quantity'=>$total_quantity,'balance_quantity'=>$total_quantity]);    
             
                $stock =$this->stockRepository->update($existingStock->id,$stockData);
                
                DB::commit();
    
                return redirect()->route('stock.index')->with('success', 'Stock updated successfully.');
            } else {
                $stockData = array_merge($request->validated(), ['user_id' => $userId]);
                $stock = $this->stockRepository->create($stockData);
    
                DB::commit();
    
                return redirect()->route('stock.index')->with('success', 'Stock created successfully.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to process stock: ' . $e->getMessage()])
                                     ->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $stock = $this->stockRepository->find($id);
        $products = $this->productRepository->all();
        return view('stock.edit', compact('stock', 'products'));
    }

    public function update(StockRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $this->stockRepository->update($id, $request->validated());

            DB::commit();

            return redirect()->route('stock.index')->with('success', 'Stock updated successfully.');
        } catch (\Exception $e) {
            
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to update stock: ' . $e->getMessage()])
                                     ->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $this->stockRepository->delete($id);

            DB::commit();

            return redirect()->route('stock.index')->with('success', 'Stock deleted successfully.');
        } catch (\Exception $e) {
            
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to delete stock: ' . $e->getMessage()])
                                     ->withInput();
        }
    }
}
