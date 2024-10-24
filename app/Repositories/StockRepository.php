<?php

namespace App\Repositories;

use App\Models\Stock;

class StockRepository implements StockRepositoryInterface
{
    public function all()
    {
        return Stock::all();
    }

    public function find($id)
    {
        return Stock::find($id);
    }

    public function create(array $data)
    {   
         $data['balance_quantity']=$data['total_quantity'];
        return Stock::create($data);
    }

    public function update($id, array $data)
    {
        $stock = $this->find($id);
        $data['balance_quantity']=$data['total_quantity'];
        $stock->update($data);
        return $stock;
    }

    public function delete($id)
    {
        $stock = $this->find($id);
        return $stock->delete();
    }
    public function findByVendor(string $id, int $vendorId)
    {
        return Stock::where('id', $id)
                    ->whereHas('product', function($query) use ($vendorId) {
                        $query->where('vendor_id', $vendorId);
                    })
                    ->firstOrFail();
    }

    public function updateByVendor(string $id, array $data, int $vendorId)
    {
        $stock = $this->findByVendor($id, $vendorId);
        $stock->update($data);
        return $stock;
    }

    public function deleteByVendor(string $id, int $vendorId)
    {
        $stock = $this->findByVendor($id, $vendorId);
        return $stock->delete();
    }
    public function findByProductAndVendor($productId, $vendorId)
    {
        return Stock::where('product_id', $productId)
                ->whereHas('product', function ($query) use ($vendorId) {
                    $query->where('user_id', $vendorId); // Assuming user_id in products table represents the vendor
                })
                ->first();
    }
}
