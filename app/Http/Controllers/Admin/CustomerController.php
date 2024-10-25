<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CustomerRequest;
use App\Repositories\CustomerRepositoryInterface;
use Spatie\Permission\Models\Role; // Import Role model


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $customerRepository;
    protected $vendorRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
   
    }
    public function index(Request $request)
    { 
            if ($request->ajax()) {
            $customers = User::select('id', 'name', 'phone', 'email','status')->where('role','customer'); 

            return DataTables::of($customers)
            ->editColumn('status', function($row) {
                return '<span class="btn btn-sm btn-warning">'.$row->status.'</span>';
            })
                ->addColumn('action', function ($customer) {
                    return '<a href="'.route('customer.edit', $customer->id).'" class="btn btn-sm btn-primary">Edit</a>
                                <a href="'.route('customer.assignRole', $customer->id).'" class="btn btn-sm btn-success">Assign Role</a>
                    <form action="'.route('customer.destroy', $customer->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>';
                })
                ->rawColumns(['status','action'])  // Allow HTML in action column

                ->make(true);
        }
        return view('customer.index'); //
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
        $customer = $this->customerRepository->find($id);  // Fetch the customer using repository
        // Fetch all customers
     
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $customer = $this->customerRepository->find($id);       
            // Update only the status field
            $this->customerRepository->update($id, $request->only('status'));
            DB::commit();
            return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.index')->with('error', 'Error updating Customer: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $this->customerRepository->delete($id);
            DB::commit();
            return redirect()->route('customer.index')->with('success', 'customer deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.index')->with('error', 'Error deleting customer: ' . $e->getMessage());
        }
    }
    public function assignRole($id)
    {
        $customer = User::findOrFail($id);
        $roles = Role::all(); // Fetch all roles

        return view('customer.assignRole', compact('customer', 'roles'));
    }

    public function storeRole(Request $request, $id)
    {
        try {           
            $request->validate([
                'role' => 'required', // Ensure the role exists in the roles table
            ]);
    
            $role = Role::findById($request->role);
            // dd($role);
            $customer = User::findOrFail($id); 
            $customer->role=$role->name;
            $customer->save();   
            $customer->assignRole($request->role);
           
            if ($role) {
                $permissions = $role->permissions()->pluck('id')->toArray();
                $customer->syncPermissions($permissions);
            }
    
            return redirect()->route('customer.index')->with('success', 'Role and permissions assigned successfully.');
        } catch (\Exception $e) {
            // Handle the exception and return an error message
            return redirect()->route('customer.index')->with('error', 'Failed to assign role: ' . $e->getMessage());
        }
    }
}
