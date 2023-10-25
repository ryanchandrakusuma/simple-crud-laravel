<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Support\Carbon;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function create(Request $request){
        $service = new Service;
        $service->client_id = $request->client_id;
        $service->notes = $request->notes;
        $service->project_id = $request->project_id;
        $service->final_price = $request->final_price;

        $service->save();
        return $service;
    }

    public function get(){
        return Service::get();
    }

    public function getByStatus($status){
        if ($status == "all"){
            return Service::with(['project', 'client'])->get();
        }
        else {
            return Service::with(['project', 'client'])->where('status', $status)->get();
        }        
    }

    public function getByClientId($clientId){

    }

    public function getById($id){
        return Service::with(['project', 'client'])->find($id);
    }

    public function update(Request $request, $id){
        $service = Service::find($id);

        if (!$service){
            return null;
        }

        $service->notes = $request->notes;
        $service->status = $request->status;
        $service->project_id = $request->project_id;

        $service->save();
        return $service;
    }

    public function updateStatus($status, $id){
        $service = Service::find($id);

        if (!$service){
            return null;
        }

        if ($status == "Approved"){
            $service->approved_on = Carbon::now();
        }
        $service->status = $status;

        $service->save();
        return $service;
    }

    public function delete($id){
        $service = Service::find($id);

        if ($service->delete()){
            return true;
        }

        return false;
    }
}
?>