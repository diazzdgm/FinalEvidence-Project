<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return view('category.index',compact('category'));
    }

    public function create(){
        return view ('category.create');
    }

    public function store(Request $request){
        Category::create([
          'Name' => $request->Name  
        ]);

        return to_route('category.index');
    }

    public function show (string $id){
        $category = Category::find($id);
        return view('category.show', compact('category'));
    }

    public function edit (string $id){
        $category = Category::find($id);

        return view ('category.edit',compact('category'));
    }

    public function update (Request $request,string $id){
        $category = Category::find($id);
        $category -> update([
            'Name' => $request->Name,
        ]);
        return to_route('category.show', $category->id);
    }

    public function destroy (Category $category){
        $category->delete();
        return redirect()->route('category.index')->with('success',);
    }
}
