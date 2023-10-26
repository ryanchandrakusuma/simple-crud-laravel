<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\VendorRepository;

class VendorController extends Controller
{
    protected $vendorRepository;

    public function __construct(VendorRepository $vendorRepository){
        $this->vendorRepository = $vendorRepository;
    }

    //for index page
    public function index(){
        //get all records
        $vendors = $this->vendorRepository->get();

        return view('vendors.index', [
            'vendors' => $vendors,
        ]);
    }

    //for vendor page based on id
    public function show($id){
        //get records based by id
        $vendor = $this->vendorRepository->getById($id);

        return view('vendors.edit', [
            'vendor' => $vendor,
        ]);
    }

    //for vendor creation page
    public function create(){
        return view('vendors.create');
    }

    //functionality
    public function store(Request $request){
        //perform update if validated
        $vendor = $this->vendorRepository->create($request);

        //null means the insertion is not success
        if ($vendor == null){
            return redirect()->route('vendors.create')->with('errors', 'Something is wrong.');
        }

        return redirect()->route('vendors.create')->with('success', 'Creation Success!');
    }

    public function update(Request $request, $id){
        //perform update if validated
        $vendor = $this->vendorRepository->update($request, $id);

        //null means the id is wrong
        if ($vendor == null){
            return redirect()->route('vendors.edit', ['id' => $id])->with('errors', 'Invalid ID.');
        }

        return redirect()->route('vendors.edit', ['id' => $id])->with('success', 'Update Success!');
    }
    
    public function destroy($id){
        //perform delete vendor
        $vendor = $this->vendorRepository->delete($id);
        if ($vendor){
            return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully');
        }
        return redirect()->route('vendors.index')->with('error', 'Failed to delete vendor');
    }
}
