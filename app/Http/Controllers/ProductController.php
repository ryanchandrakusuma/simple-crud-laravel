<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ProductRepository;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }

    //for index page
    public function index(){
        //get all records
        $products = $this->productRepository->get();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    //for product page based on id
    public function show($id){
        //get records based by id
        $product = $this->productRepository->getById($id);

        return view('products.edit', [
            'product' => $product,
        ]);
    }

    //for product creation page
    public function create(){
        return view('products.create');
    }

    //functionality
    public function store(Request $request){
        //perform update if validated
        $product = $this->productRepository->create($request);

        //null means the insertion is not success
        if ($product == null){
            return redirect()->route('products.create')->with('errors', 'Something is wrong.');
        }

        return redirect()->route('products.create')->with('success', 'Creation Success!');
    }

    public function update(Request $request, $id){
        //perform update if validated
        $product = $this->productRepository->update($request, $id);

        //null means the id is wrong
        if ($product == null){
            return redirect()->route('products.edit', ['id' => $id])->with('errors', 'Invalid ID.');
        }

        return redirect()->route('products.edit', ['id' => $id])->with('success', 'Update Success!');
    }
    
    public function destroy($id){
        //perform delete product
        $product = $this->productRepository->delete($id);
        if ($product){
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        }
        return redirect()->route('products.index')->with('error', 'Failed to delete product');
    }
}
