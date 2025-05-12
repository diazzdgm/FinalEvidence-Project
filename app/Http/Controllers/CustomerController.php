<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller

{
    public function index(){
        $customer = Customer::all();
        return view('customer.index',compact('customer'));
    }

    public function create(){
        return view ('customer.create');
    }

    public function store(Request $request){
        Customer::create([
          'Name' => $request->Name,
          'Email' => $request->Email,
          'Phone' => $request->Phone,

        ]);

        return to_route('customer.index');
    }

    public function show (string $id){
        $customer = Customer::find($id);
        return view('customer.show', compact('customer'));
    }

    public function edit (string $id){
        $customer = Customer::find($id);

        return view ('customer.edit',compact('customer'));
    }

    public function update (Request $request,string $id){
        $customer = Customer::find($id);
        $customer -> update([
           'Name' => $request->Name,
          'Email' => $request->Email,
          'Phone' => $request->Phone,

        ]);
        return to_route('customer.show', $customer->id);
    }

    public function destroy (Customer $customer){
        // Verificar si el cliente tiene órdenes asociadas
        if ($customer->orders()->exists()) {
            // Si tiene órdenes, redirigir con un mensaje de error
            return redirect()->route('customer.index')
                             ->with('error', 'No se puede eliminar el cliente "'.$customer->Name.'" porque tiene órdenes asociadas.');
        }

        // Si no tiene órdenes, proceder con la eliminación
        $customer->delete();
        return redirect()->route('customer.index')
                         ->with('success', 'Cliente "'.$customer->Name.'" eliminado exitosamente.');
    }
}
