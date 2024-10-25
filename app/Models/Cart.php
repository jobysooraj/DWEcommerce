<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'status',
        
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Define the relationship to the User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
