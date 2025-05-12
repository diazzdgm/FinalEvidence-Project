<?php

namespace App\Http\Controllers;
use App\Models\InventoryMovement;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\Category;

use Illuminate\Http\Request;

class InventoryMovementController extends Controller
{
    public function index(){
        $IM = InventoryMovement::all();
        return view('InventoryMovement.index',compact('IM'));
    }

    public function create(){
        $product = Product::all();  
        $User_ID = User::all();  

        return view('InventoryMovement.create', compact('product', 'User_ID'));
    }

    public function store(Request $request){
        InventoryMovement::create([
            
            'Product_ID'=> $request->Product_ID,
            'Movement_Type'=> $request->Movement_Type,
            'Quantity'=> $request->Quantity,
            'User_ID'=> $request->User_ID
            
        ]);
        return redirect()->route('im.index');

        
    }

    public function show (string $id){
        $IM = InventoryMovement::find($id);
        return view('InventoryMovement.show', compact('IM'));
    }

    public function edit(string $id)
    {
        $IM = InventoryMovement::find($id);
        $product = Product::all();  
        $UserID = User::all(); 
    
        return view('InventoryMovement.edit', compact('product', 'IM', 'UserID'));
    }

    public function update (Request $request,string $id){
        $IM = InventoryMovement::find($id);
        $IM -> update([
           
            'Product_ID'=> $request->Product_ID,
            'Movement_Type'=> $request->Movement_Type,
            'Quantity'=> $request->Quantity,
            'User_ID'=> $request->User_ID
            
        ]);
        return to_route('im.show', $IM->id);
    }

    public function destroy (Product $product){
        $product->delete();
        return redirect()->route('im.index')->with('success',);
    }

    
}