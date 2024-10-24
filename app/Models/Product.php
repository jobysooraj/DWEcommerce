<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'description',
        'price',
        'image',
        
    ];
    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id'); // Adjust the foreign key if needed
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
