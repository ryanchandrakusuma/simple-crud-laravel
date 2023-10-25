<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Support\Carbon;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function create(Request $request){

    }

    public function get(){
        return Invoice::with('client', 'services.project')->get();
    }

    public function getByStatus($status){
   
    }

    public function getByClientId($clientId){

    }

    public function getById($id){

    }

    public function update(Request $request, $id){

    }

    public function updateStatus($status, $id){

    }

    public function delete($id){

    }
}
?>