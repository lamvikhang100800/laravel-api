<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{   
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_name','product_isActive', 'product_init', 'product_price', 'product_quantity', 'category_id', 'updated_at', 'created_at'];

}
