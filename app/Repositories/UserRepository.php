<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::where('role','vendor')->get();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        $data['status'] = 'active'; 
        $data['role'] = 'vendor';
       
            $user = User::create($data);
            // Assign vendor role
            $user->assignRole('vendor');

            return $user; // Return the user object

       
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);
        $user->update($data);
        if (isset($data['role'])) {
            $user->syncRoles([$data['role']]); // Sync roles to avoid duplicates
        }
        return $user;
    }

    public function delete($id)
    {
        $vendor = $this->find($id);
        return $vendor->delete();
    }
}
