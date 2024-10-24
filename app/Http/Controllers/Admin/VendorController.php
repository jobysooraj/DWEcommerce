<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreVendorRequest;
use App\Repositories\UserRepositoryInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index(Request $request)
    {        
        if ($request->ajax()) {
            $vendors = User::where('role','vendor')->select('id', 'name', 'phone', 'email'); 
            return DataTables::of($vendors)
                ->addColumn('action', function ($vendor) {
                    return '<a href="'.route('vendor.edit', $vendor->id).'" class="btn btn-sm btn-primary">Edit</a>
                            <form action="'.route('vendor.destroy', $vendor->id).'" method="POST" style="display:inline;">
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
        try {
           
            DB::beginTransaction();

            $user = $this->userRepository->create($request->validated());
            $user->assignRole('vendor');

            DB::commit();

            return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
        } catch (\Exception $e) {
            
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to create vendor: ' . $e->getMessage()])
                                     ->withInput();
        }
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
        $vendor = $this->userRepository->find($id);  // Fetch the vendor using repository
           // Fetch all vendors
        
        return view('vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreVendorRequest $request, $id)
    {
        try {
            
            DB::beginTransaction();

            $this->userRepository->update($id, $request->validated());

            DB::commit();

            return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to update vendor: ' . $e->getMessage()])
                                     ->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            
            DB::beginTransaction();

            $this->userRepository->delete($id);

            DB::commit();

            return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to delete vendor: ' . $e->getMessage()])
                                     ->withInput();
        }
    }
}
