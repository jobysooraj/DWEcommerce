<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PermissionRepositoryInterface;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $users = User::with('roles')->get();
            $roles = Role::with('permissions')->get();        
        return DataTables::of($roles)
           
            ->addColumn('role', function($role) {
                return $role->name;
            })
            ->addColumn('action', function($role) {
                // Add action buttons (edit, delete, etc.)
                return '<a href="'.route('permission.edit', $role->id).'" class="btn btn-sm btn-warning">Assign Permission</a>';
               
            //     <form action="' . route('permission.destroy', $role->id) . '" method="POST" style="display:inline;">
            //     ' . csrf_field() . '
            //     ' . method_field('DELETE') . '
            //     <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            // </form>';
            })
            ->rawColumns(['action']) 
            ->make(true);
        }
       return view('permission.index');
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
        $role = Role::findOrFail($id); 
        $allPermissions = $this->permissionRepository->listAll();
        $userPermissions = $role->getAllPermissions()->pluck('name')->toArray(); 
        return view('permission.edit', compact('role', 'allPermissions', 'userPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $permissions = $request->input('permissions', []);
        
            // Sync permissions with the role
            $role->syncPermissions($permissions);
        
            return redirect()->route('permission.index')->with('success', 'Permissions updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update permission: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {           
            $role = Role::findOrFail($id);    
            if ($role) {              
                $role->revokePermissionTo($role->permissions);
                $user->removeRole($role);
            }
            return redirect()->route('permission.index')->with('success', 'User role and permissions deleted successfully..');
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update permission: ' . $e->getMessage()], 500);
        }
    }
}
