<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\VendorRepositoryInterface;
use App\Models\Vendor;

class VendorRepository implements VendorRepositoryInterface
{
    public function create(Request $request){
        $vendor = new Vendor;
        $vendor->name = $request->name;
        $vendor->address = $request->address;

        if ($vendor->save()){
            return $vendor;
        }
        return null;
        
    }

    public function get(){
        return Vendor::get();
    }

    public function getById($id){
        return Vendor::find($id);
    }

    public function update(Request $request, $id){
        $vendor = Vendor::find($id);

        if (!$vendor){
            return null;
        }

        $vendor->name = $request->name;
        $vendor->address = $request->address;

        $vendor->save();

        return $vendor;
    }

    public function delete($id){
        $vendor = Vendor::find($id);

        if ($vendor->delete()){
            return true;
        }

        return false;
    }
}

?>