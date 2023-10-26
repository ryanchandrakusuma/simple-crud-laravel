<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\WarehouseRepositoryInterface;
use App\Models\Warehouse;

class WarehouseRepository implements WarehouseRepositoryInterface
{
    public function create(Request $request){
        $warehouse = new Warehouse;
        $warehouse->name = $request->name;
        $warehouse->address = $request->address;

        if ($warehouse->save()){
            return $warehouse;
        }
        return null;
        
    }

    public function get(){
        return Warehouse::get();
    }

    public function getById($id){
        return Warehouse::find($id);
    }

    public function update(Request $request, $id){
        $warehouse = Warehouse::find($id);

        if (!$warehouse){
            return null;
        }

        $warehouse->name = $request->name;
        $warehouse->address = $request->address;

        $warehouse->save();

        return $warehouse;
    }

    public function delete($id){
        $warehouse = Warehouse::find($id);

        if ($warehouse->delete()){
            return true;
        }

        return false;
    }
}

?>