<?php

namespace App\Repositories;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByVendor($productId, $vendorId);
    public function deleteByVendor($productId, $vendorId);
    public function getByVendor(int $vendorId); // Add this line


}
