<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\WarehouseProductRepository;
use App\Repository\WarehouseRepository;

class StokGudangController extends Controller
{
    protected $warehouseProductRepository;
    protected $warehouseRepository;

    public function __construct(WarehouseProductRepository $warehouseProductRepository, WarehouseRepository $warehouseRepository){
        $this->warehouseProductRepository = $warehouseProductRepository;
        $this->warehouseRepository = $warehouseRepository;
    }

    //for index page
    public function index(){
        //get all records
        $warehouseProducts = $this->warehouseProductRepository->get();
        $warehouses = $this->warehouseRepository->get();

        return view('stok-gudang.index', [
            'warehouses' => $warehouses,
            'warehouseProduct' => $warehouseProducts,
        ]);
    }

    //for warehouseProduct page based on id
    public function show($id){

    }

    //for warehouseProduct creation page
    public function create(){
        return view('stok-gudang.create');
    }

    public function filter(Request $request){
        $warehouse_id = $request->warehouse_id;

        $warehouseProducts = $this->warehouseProductRepository->getByWarehouseId($warehouse_id);

        return response()->json($warehouseProducts);
    }

    //functionality
    public function store(Request $request){

    }

    public function update(Request $request, $id){

    }
    
    public function destroy($id){

    }
}
