<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Products::class, 'warehouses_products', 'product_id', 'warehouse_id');
    }
}
