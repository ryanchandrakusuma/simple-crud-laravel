<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\WarehouseRepository;

class WarehouseController extends Controller
{
    protected $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepository){
        $this->warehouseRepository = $warehouseRepository;
    }

    //for index page
    public function index(){
        //get all records
        $warehouses = $this->warehouseRepository->get();

        return view('warehouses.index', [
            'warehouses' => $warehouses,
        ]);
    }

    //for warehouse page based on id
    public function show($id){
        //get records based by id
        $warehouse = $this->warehouseRepository->getById($id);

        return view('warehouses.edit', [
            'warehouse' => $warehouse,
        ]);
    }

    //for warehouse creation page
    public function create(){
        return view('warehouses.create');
    }

    //functionality
    public function store(Request $request){
        //perform update if validated
        $warehouse = $this->warehouseRepository->create($request);

        //null means the insertion is not success
        if ($warehouse == null){
            return redirect()->route('warehouses.create')->with('errors', 'Something is wrong.');
        }

        return redirect()->route('warehouses.create')->with('success', 'Creation Success!');
    }

    public function update(Request $request, $id){
        //perform update if validated
        $warehouse = $this->warehouseRepository->update($request, $id);

        //null means the id is wrong
        if ($warehouse == null){
            return redirect()->route('warehouses.edit', ['id' => $id])->with('errors', 'Invalid ID.');
        }

        return redirect()->route('warehouses.edit', ['id' => $id])->with('success', 'Update Success!');
    }
    
    public function destroy($id){
        //perform delete warehouse
        $warehouse = $this->warehouseRepository->delete($id);
        if ($warehouse){
            return redirect()->route('warehouses.index')->with('success', 'Warehouse deleted successfully');
        }
        return redirect()->route('warehouses.index')->with('error', 'Failed to delete warehouse');
    }
}
