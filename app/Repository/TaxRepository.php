<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\TaxRepositoryInterface;
use App\Models\Tax;

class TaxRepository implements TaxRepositoryInterface
{
    public function create(Request $request){
        $tax = new Tax;
        $tax->name = $request->name;
        $tax->percent = $request->percent;

        if ($tax->save()){
            return $tax;
        }
        return null;
        
    }

    public function get(){
        return Tax::get();
    }

    public function getById($id){
        return Tax::find($id);
    }

    public function update(Request $request, $id){
        $tax = Tax::find($id);

        if (!$tax){
            return null;
        }

        $tax->name = $request->name;
        $tax->percent = $request->percent;

        $tax->save();

        return $tax;
    }

    public function delete($id){
        $tax = Tax::find($id);

        if ($tax->delete()){
            return true;
        }

        return false;
    }
}

?>