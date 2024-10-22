<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use App\Repositories\VendorRepositoryInterface;
use Yajra\DataTables\DataTables;


class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $vendorRepository;

    public function __construct(VendorRepositoryInterface $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $vendors = Vendor::select('id', 'name', 'phone', 'email', 'address'); 

            return DataTables::of($vendors)
                ->addColumn('action', function ($vendor) {
                    return '<a href="'.route('admin.vendor.edit', $vendor->id).'" class="btn btn-sm btn-primary">Edit</a>
                            <form action="'.route('admin.vendor.destroy', $vendor->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>';
                })
                ->make(true);
        }
        return view('vendors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request)
    {
        $vendor = $this->vendorRepository->create($request->validated());
        return redirect()->route('admin.vendor.index')->with('success', 'Vendor created successfully.');
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
