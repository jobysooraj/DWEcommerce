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
        dd("Sdsdsdds");
        $data['status'] = 'active'; 
        $data['role'] = 'vendor';
        try {
            // Create user
            $user = User::create($data);
            // Assign vendor role
            // $user->assignRole('vendor');

            return $user; // Return the user object

        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error creating user: ' . $e->getMessage());
            throw new \Exception('Failed to create vendor user.');
        }
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
