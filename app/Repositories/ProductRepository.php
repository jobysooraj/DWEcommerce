<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Storage; // Import the Storage facade


use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::all();
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function create(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('products', 'public'); // Store the image
        }
        return Product::create($data);
    }

    public function update($id, array $data)
    {

        $product = $this->find($id);
        if (isset($data['image'])) {
            // Optionally delete the old image
            Storage::disk('public')->delete($product->image);
            $data['image'] = $data['image']->store('products', 'public');
        }
        $product->update($data);
        
        return $product;
    }

    public function delete($id)
    {
        $product = $this->find($id);
        return $product->delete();
    }
    public function findByVendor($productId, $vendorId)
    {
        return Product::where('id', $productId)
                    ->where('user_id', $vendorId)
                    ->firstOrFail();
    }

    public function deleteByVendor($productId, $vendorId)
    {
        return Product::where('id', $productId)
                    ->where('user_id', $vendorId)
                    ->delete();
    }
    public function getByVendor(int $vendorId)
    {
        return Product::where('user_id', $vendorId)->get();
    }

}
