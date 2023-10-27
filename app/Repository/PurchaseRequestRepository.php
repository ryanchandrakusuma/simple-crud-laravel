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
        return PurchaseRequest::with('vendor', 'tax', 'details.product')->get();
    }

    public function getById($id){
        return PurchaseRequest::with('vendor', 'tax', 'details.product')->where('id', $id)->first();
    }

    public function update(Request $request, $id)
    {
        $purchaseRequest = PurchaseRequest::find($id);
        $purchaseRequest->vendor_id = $request->vendor_id;
        $purchaseRequest->tax_id = $request->tax_id;
        $purchaseRequest->status = $request->status;
    
        $originalDetails = $purchaseRequest->details;
    
        $existingDetails = [];
        $newlyAddedDetails = [];

        foreach ($request->selected_products as $index => $productId) {
            $prDetails = new PurchaseRequestDetail;
            $prDetails->product_id = $productId;
            $prDetails->amount = $request->amount[$index];
            $prDetails->price_pcs = $request->pricePcs[$index];
            $prDetails->price_total = $request->priceTotal[$index];
    
            $originalDetail = $originalDetails->where('product_id', $productId)->first();
    
            if ($originalDetail) {
                $existingDetails[] = $prDetails;
    
                $originalDetail->amount = $prDetails->amount;
                $originalDetail->price_pcs = $prDetails->price_pcs;
                $originalDetail->price_total = $prDetails->price_total;
                $originalDetail->save();
            } else {
                $newlyAddedDetails[] = $prDetails;
            }
        }
    
        foreach ($originalDetails as $originalDetail) {
            if (!in_array($originalDetail->product_id, $request->selected_products)) {
                $originalDetail->delete();
            }
        }
    
        $purchaseRequest->details()->saveMany($newlyAddedDetails);
    
        $totalPrice = $purchaseRequest->details->sum('price_total');
    
        $tax = Tax::find($request->tax_id);
        $purchaseRequest->price_total = $totalPrice * (1 + ($tax->percent / 100));
    
        if ($purchaseRequest->save()) {
            return $purchaseRequest;
        }
    
        return null;
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