<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\PurchaseRequestRepository;
use App\Repository\ProductRepository;
use App\Repository\TaxRepository;
use App\Repository\VendorRepository;

class PurchaseRequestController extends Controller
{
    protected $purchaseRequestRepository;
    protected $taxRepository;
    protected $vendorRepository;
    protected $productRepository;

    public function __construct(PurchaseRequestRepository $purchaseRequestRepository, TaxRepository $taxRepository, VendorRepository $vendorRepository, ProductRepository $productRepository){
        $this->purchaseRequestRepository = $purchaseRequestRepository;
        $this->taxRepository = $taxRepository;
        $this->vendorRepository = $vendorRepository;
        $this->productRepository = $productRepository;
    }

    //for index page
    public function index(){
        //get all records
        $purchaseRequests = $this->purchaseRequestRepository->get();

        return view('purchase-request.index', [
            'purchaseRequests' => $purchaseRequests,
        ]);
    } 

    //for purchaseRequest page based on id
    public function show($id){
        $pr = $this->purchaseRequestRepository->getById($id);
        $vendors = $this->vendorRepository->get();
        $taxes = $this->taxRepository->get();
        $products = $this->productRepository->get();

        return view('purchase-request.edit', [
            'purchase_request' => $pr,
            'vendors' => $vendors,
            'taxes' => $taxes,
            'products' => $products,
        ]);
    }

    //for purchaseRequest creation page
    public function create(){
        $vendors = $this->vendorRepository->get();
        $taxes = $this->taxRepository->get();
        $products = $this->productRepository->get();

        return view('purchase-request.create', [
            'vendors' => $vendors,
            'taxes' => $taxes,
            'products' => $products,
        ]);
    }

    public function filter(Request $request){
        $status = $request->status;

        $purchaseRequests = $this->purchaseRequestRepository->getByStatus($status);

        return response()->json($purchaseRequests);
    }

    //functionality
    public function store(Request $request){
        //perform update if validated
        $purchaseRequest = $this->purchaseRequestRepository->create($request);

        //null means the insertion is not success
        if ($purchaseRequest == null){
            return redirect()->route('purchase-request.create')->with('errors', 'Something is wrong.');
        }

        return redirect()->route('purchase-request.create')->with('success', 'Creation Success!');
    }

    public function update(Request $request, $id){
        //perform update if validated
        $purchaseRequest = $this->purchaseRequestRepository->update($request, $id);

        //null means the id is wrong
        if ($purchaseRequest == null){
            return redirect()->route('purchase-request.edit', ['id' => $id])->with('errors', 'Invalid ID.');
        }

        return redirect()->route('purchase-request.edit', ['id' => $id])->with('success', 'Update Success!');
    }
    
    public function destroy($id){

    }

    public function approve($id){
        //perform update if validated
        $purchaseRequest = $this->purchaseRequestRepository->updateStatusToApproved($id);

        //null means the id is wrong
        if ($purchaseRequest == null){
            return redirect()->route('purchase-request.edit', ['id' => $id])->with('errors', 'Invalid ID.');
        }

        return redirect()->route('purchase-request.edit', ['id' => $id])->with('success', 'Update Success!');
    }
}
