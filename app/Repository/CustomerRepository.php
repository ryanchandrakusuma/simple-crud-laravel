<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function create(Request $request){
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->address = $request->address;

        if ($customer->save()){
            return $customer;
        }
        return null;
        
    }

    public function get(){
        return Customer::get();
    }

    public function getById($id){
        return Customer::find($id);
    }

    public function update(Request $request, $id){
        $customer = Customer::find($id);

        if (!$customer){
            return null;
        }

        $customer->name = $request->name;
        $customer->address = $request->address;

        $customer->save();

        return $customer;
    }

    public function delete($id){
        $customer = Customer::find($id);

        if ($customer->delete()){
            return true;
        }

        return false;
    }
}

?>