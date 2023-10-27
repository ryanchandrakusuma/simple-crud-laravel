<?php

namespace App\Repository;

use Illuminate\Http\Request;
use App\Interfaces\PurchaseRequestRepositoryInterface;
use App\Models\PurchaseRequestDetail;
use App\Models\PurchaseRequest;
use App\Models\Tax;

class PurchaseRequestRepository implements PurchaseRequestRepositoryInterface
{
    public function create(Request $request) {
        $purchaseRequest = new PurchaseRequest;
        $purchaseRequest->vendor_id = $request->vendor_id;
        $purchaseRequest->tax_id = $request->tax_id;
        $purchaseRequest->status = "Pending";
    
        $detailsToSave = [];
        $totalPrice = 0;
    
        foreach ($request->products as $index => $productId) {
            $prDetails = new PurchaseRequestDetail;
            $prDetails->product_id = $productId;
            $prDetails->amount = $request->amount[$index];
            $prDetails->price_pcs = $request->pricePcs[$index];
            $prDetails->price_total = $request->priceTotal[$index];
    
            $detailsToSave[] = $prDetails;
    
            $totalPrice += $request->priceTotal[$index];
        }
    
        $tax = Tax::where('id', $request->tax_id)->first();
    
        $purchaseRequest->price_total = $totalPrice * ((100 + $tax->percent) / 100);
    
        if ($purchaseRequest->save()) {
            foreach ($detailsToSave as $prDetails) {
                $prDetails->purchase_request_id = $purchaseRequest->id;
                $prDetails->save();
            }
    
            return $purchaseRequest;
        }
    
        return null;
    }

    public function get(){
        return PurchaseRequest::with('vendor', 'tax')->get();
    }

    public function getById($id){

    }

    public function update(Request $request, $id){

    }

    public function delete($id){

    }

    public function getByStatus($status){
        return PurchaseRequest::with('vendor', 'tax')
        ->where('status', $status)
        ->get();
    }

}

?>