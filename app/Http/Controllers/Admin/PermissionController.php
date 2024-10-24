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
            $users = User::with('roles')->get();
                       
        return DataTables::of($users)
            ->addColumn('user', function($permission) {
                return $permission->name ?? 'N/A'; 
            })
            ->addColumn('role', function($user) {
                return $user->roles->pluck('name')->implode(', ') ?? 'No Role Assigned'; 
            })
            ->addColumn('action', function($permission) {
                // Add action buttons (edit, delete, etc.)
                return '<a href="'.route('permission.edit', $permission->id).'" class="btn btn-sm btn-warning">Edit</a>
               
                <form action="' . route('permission.destroy', $permission->id) . '" method="POST" style="display:inline;">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>';
            })
            ->rawColumns(['action']) // Allow raw HTML for action buttons
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
        $user = User::with('roles')->findOrFail($id); // Retrieve the user and their roles
    
        // Get all permissions
        $allPermissions = $this->permissionRepository->listAll();
        
        // Get the user's assigned permissions
        $userPermissions = $user->getAllPermissions()->pluck('name')->toArray(); // Get user's permissions
    
        // Pass user, all permissions, and user's permissions to the view
        return view('permission.edit', compact('user', 'allPermissions', 'userPermissions'));
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
            // Find the user by ID
            $user = User::findOrFail($id);
            
            // Get the role associated with the user
            $role = $user->roles->first(); // Assumes the user has only one role
    
            if ($role) {
                // Remove all permissions from the role if desired
                $role->revokePermissionTo($role->permissions);
    
                // Detach the role from the user
                $user->removeRole($role);
            }
            return redirect()->route('permission.index')->with('success', 'User role and permissions deleted successfully..');
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update permission: ' . $e->getMessage()], 500);
        }
    }
}
