<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\WarehouseProductRepositoryInterface;
use App\Models\WarehouseProduct;

class WarehouseProductRepository implements WarehouseProductRepositoryInterface
{
    public function create(Request $request){

    }

    public function get(){
        return WarehouseProduct::with('product', 'warehouse')->get();
    }

    public function getById($id){

    }

    public function update(Request $request, $id){

    }

    public function delete($id){

    }

    public function getByWarehouseId($id){
        return WarehouseProduct::with('product', 'warehouse')
        ->where('warehouse_id', $id)
        ->get();
    }

    public function getByProductId($id){

    }

}

?>