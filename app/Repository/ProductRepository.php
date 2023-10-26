<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(Request $request){
        $product = new Product;
        $product->name = $request->name;

        if ($product->save()){
            return $product;
        }
        return null;
        
    }

    public function get(){
        return Product::get();
    }

    public function getById($id){
        return Product::find($id);
    }

    public function update(Request $request, $id){
        $product = Product::find($id);

        if (!$product){
            return null;
        }

        $product->name = $request->name;
        $product->address = $request->address;

        $product->save();

        return $product;
    }

    public function delete($id){
        $product = Product::find($id);

        if ($product->delete()){
            return true;
        }

        return false;
    }
}

?>