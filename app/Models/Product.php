<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name',
        'vendor_id',
        'description',
        'price',
        'image',
        
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id'); // Adjust the foreign key if needed
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
