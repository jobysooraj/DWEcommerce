<?php

namespace App\Repositories;

use App\Models\Stock;

interface StockRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByVendor(string $id, int $vendorId);
    public function updateByVendor(string $id, array $data, int $vendorId);
    public function deleteByVendor(string $id, int $vendorId);
}
