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
        // Verificar si la categoría tiene productos asociados
        if ($category->products()->exists()) { // Usar exists() es más eficiente que count() > 0 si solo necesitas saber si hay alguno
            // Si tiene productos, redirigir con un mensaje de error
            return redirect()->route('category.index')
                             ->with('error', 'No se puede eliminar la categoría "'.$category->Name.'" porque tiene productos asociados.');
        }

        // Si no tiene productos, proceder con la eliminación
        $category->delete();
        return redirect()->route('category.index')
                         ->with('success', 'Categoría "'.$category->Name.'" eliminada exitosamente.');
    }
}
