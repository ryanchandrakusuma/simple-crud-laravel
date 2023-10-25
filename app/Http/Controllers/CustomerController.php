<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\CustomerRepository;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository){
        $this->customerRepository = $customerRepository;
    }

    //for index page
    public function index(){
        //get all records
        $customers = $this->customerRepository->get();

        return view('customers.index', [
            'customers' => $customers,
        ]);
    }

    //for customer page based on id
    public function show($id){
        //get records based by id
        $customer = $this->customerRepository->getById($id);

        return view('customers.edit', [
            'customer' => $customer,
        ]);
    }

    //for customer creation page
    public function create(){
        return view('customers.create');
    }

    //functionality
    public function store(Request $request){
        //perform update if validated
        $customer = $this->customerRepository->create($request);

        //null means the insertion is not success
        if ($customer == null){
            return redirect()->route('customers.create')->with('errors', 'Something is wrong.');
        }

        return redirect()->route('customers.create')->with('success', 'Creation Success!');
    }

    public function update(Request $request, $id){
        //perform update if validated
        $customer = $this->customerRepository->update($request, $id);

        //null means the id is wrong
        if ($customer == null){
            return redirect()->route('customers.edit', ['id' => $id])->with('errors', 'Invalid ID.');
        }

        return redirect()->route('customers.edit', ['id' => $id])->with('success', 'Update Success!');
    }
    
    public function destroy($id){
        //perform delete customer
        $customer = $this->customerRepository->delete($id);
        if ($customer){
            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
        }
        return redirect()->route('customers.index')->with('error', 'Failed to delete customer');
    }
}
