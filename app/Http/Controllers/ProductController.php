<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use App\Models\Category;
use App\Models\Customer; // Added Customer model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $product = Product::all();
        return view('product.index',compact('product'));
    }
    public function create(){
        // $customer = Customer::all();  // This variable is not used in the view
        $WH = Warehouse::all(); // Corrected variable name and fetched Warehouses
        $CatID = Category::all(); 

        return view('product.create', compact('WH', 'CatID'));
    }

    public function store(Request $request){
        Product::create([
            
            'Name' => $request->Name,
            'Description' => $request ->Description,
            'Unit_Price' => $request ->Unit_Price,
            'Stock' => $request ->Stock, 
            'Warehouse' => $request ->Warehouse,
            'Category_ID' => $request ->Category_ID
            
        ]);
        return redirect()->route('product.index');

        
    }

    public function show (string $id){
        $product = Product::find($id);
        return view('product.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::find($id);
        $WH = Warehouse::all();  
        $CatID = Category::all(); 
    
        return view('product.edit', compact('product', 'WH', 'CatID'));
    }

    public function update (Request $request,string $id){
        $product = Product::find($id);
        $product -> update([
            'Name' => $request->Name,
            'Description' => $request ->Description,
            'Unit_Price' => $request ->Unit_Price,
            'Stock' => $request ->Stock, 
            'Warehouse' => $request ->Warehouse,
            'Category_ID' => $request ->Category_ID
            
        ]);
        return to_route('product.show', $product->id);
    }

    public function destroy (Product $product){
        $product->delete();
        return redirect()->route('product.index')->with('success',);
    }

    
}
