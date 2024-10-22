<?php

namespace App\Repositories;

use App\Models\Vendor;

class VendorRepository implements VendorRepositoryInterface
{
    public function all()
    {
        return Vendor::all();
    }

    public function find($id)
    {
        return Vendor::find($id);
    }

    public function create(array $data)
    {
        return Vendor::create($data);
    }

    public function update($id, array $data)
    {
        $vendor = $this->find($id);
        $vendor->update($data);
        return $vendor;
    }

    public function delete($id)
    {
        $vendor = $this->find($id);
        return $vendor->delete();
    }
}
