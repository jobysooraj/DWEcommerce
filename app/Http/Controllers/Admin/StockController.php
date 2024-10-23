<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $stocks = Stock::with(['product', 'product.vendor'])->get(); // Eager load relationships

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
                ->editColumn('vendor', function($row) {
                    return $row->product->vendor->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('stock.index'); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
