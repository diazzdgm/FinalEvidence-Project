<?php

namespace App\Http\Controllers;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(){
        $warehouse = Warehouse::all();
        return view('warehouse.index',compact('warehouse'));
    }

    public function create(){
        return view ('warehouse.create');
    }

    public function store(Request $request){
        Warehouse::create([
          'Name' => $request->Name  
        ]);

        return to_route('warehouse.index');
    }

    public function show (string $id){
        $warehouse = Warehouse::find($id);
        return view('warehouse.show', compact('warehouse'));
    }

    public function edit (string $id){
        $warehouse = Warehouse::find($id);

        return view ('warehouse.edit',compact('warehouse'));
    }

    public function update (Request $request,string $id){
        $warehouse = Warehouse::find($id);
        $warehouse -> update([
            'Name' => $request->Name,
        ]);
        return to_route('warehouse.show', $warehouse->id);
    }

    public function destroy (Warehouse $warehouse){
        $warehouse->delete();
        return redirect()->route('warehouse.index')->with('success',);
    }
}
