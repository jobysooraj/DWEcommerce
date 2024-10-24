<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function create(array $data)
    {
        return Permission::create($data);
    }

    public function findByName(string $name)
    {
        return Permission::where('name', $name)->first();
    }

    public function listAll()
    {
        return Permission::all();
    }
    public function delete($id)
    {
        $permission = Permission::findOrFail($id);
        return $permission->delete();
    }
    public function update($id, array $data)
    {
        $permission = $this->findById($id);
        $permission->update($data);
        return $permission;
    }
}
