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
        return Stock::create($data);
    }

    public function update($id, array $data)
    {
        $stock = $this->find($id);
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
}
