<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;

class OrderController extends Controller
{
    public function index(){
        $order = Order::all();
        return view('order.index',compact('order'));
    }
    public function create(){
        $customer = Customer::all();  
        $user = User::all(); 

        return view('order.create', compact('customer', 'user'));

    }

    public function store(Request $request){
        Order::create([
            
            'Customer_ID' => $request->Customer_ID,
            'User_ID' => $request ->User_ID,
            'Status' => $request ->Status
            
        ]);
        return redirect()->route('order.index');

        
    }

    public function show (string $id){
        $order = Order::find($id);
        return view('order.show', compact('order'));
    }

    public function edit(string $id)
    {
        $order = Order::find($id);
        $customer = Customer::all();  
        $user = User::all(); 
    
        return view('order.edit', compact('order', 'user', 'customer'));
    }

    public function update (Request $request,string $id){
        $order = Order::find($id);
        $order -> update([
            'Customer_ID' => $request->Customer_ID,
            'User_ID' => $request ->User_ID,
            'Status' => $request ->Status
            
        ]);
        return to_route('order.show', $order->id);
    }

    public function destroy (Order $order){
        $order->delete();
        return redirect()->route('order.index')->with('success',);
    }


    
}
