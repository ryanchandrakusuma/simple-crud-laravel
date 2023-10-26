<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\TaxRepository;

class TaxController extends Controller
{
    protected $taxRepository;

    public function __construct(TaxRepository $taxRepository){
        $this->taxRepository = $taxRepository;
    }

    //for index page
    public function index(){
        //get all records
        $taxes = $this->taxRepository->get();

        return view('taxes.index', [
            'taxes' => $taxes,
        ]);
    }

    //for tax page based on id
    public function show($id){
        //get records based by id
        $tax = $this->taxRepository->getById($id);

        return view('taxes.edit', [
            'tax' => $tax,
        ]);
    }

    //for tax creation page
    public function create(){
        return view('taxes.create');
    }

    //functionality
    public function store(Request $request){
        //perform update if validated
        $tax = $this->taxRepository->create($request);

        //null means the insertion is not success
        if ($tax == null){
            return redirect()->route('taxes.create')->with('errors', 'Something is wrong.');
        }

        return redirect()->route('taxes.create')->with('success', 'Creation Success!');
    }

    public function update(Request $request, $id){
        //perform update if validated
        $tax = $this->taxRepository->update($request, $id);

        //null means the id is wrong
        if ($tax == null){
            return redirect()->route('taxes.edit', ['id' => $id])->with('errors', 'Invalid ID.');
        }

        return redirect()->route('taxes.edit', ['id' => $id])->with('success', 'Update Success!');
    }
    
    public function destroy($id){
        //perform delete tax
        $tax = $this->taxRepository->delete($id);
        if ($tax){
            return redirect()->route('taxes.index')->with('success', 'Tax deleted successfully');
        }
        return redirect()->route('taxes.index')->with('error', 'Failed to delete tax');
    }
}
