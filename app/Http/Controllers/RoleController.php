<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $role = Role::all();
        return view('role.index',compact('role'));
    }

    public function create(){
        return view ('role.create');
    }

    public function store(Request $request){
        Role::create([
          'Name' => $request->Name,
          'Description' => $request->Description,
        ]);

        return to_route('role.index');
    }

    public function show (string $id){
        $role = Role::find($id);
        return view('role.show', compact('role'));
    }

    public function edit (string $id){
        $role = Role::find($id);

        return view ('role.edit',compact('role'));
    }

    public function update (Request $request,string $id){
        $role = Role::find($id);
        $role -> update([
            'Name' => $request->Name,
            'Description' => $request->Description

        ]);
        return to_route('role.show', $role->id);
    }

    public function destroy (Role $role){
        $role->delete();
        return redirect()->route('role.index')->with('success',);
    }
}
