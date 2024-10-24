<?php

namespace App\Repositories;

use App\Models\User;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $customer = $this->find($id);
        $customer->update($data);
        return $customer;
    }

    public function delete($id)
    {
        $customer = $this->find($id);
        return $customer->delete();
    }
}
