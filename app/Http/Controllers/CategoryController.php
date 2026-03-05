<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(){
        return Inertia::render("Categories/Index",[
          'categories'=>Category::latest()->get()
        ]);
    }
    public function store(Request $request){
            $validated=$request->validate([
                'name'=>'required'
            ]);
            $validated['slug']=\Str::slug($validated['name']);
            Category::create($validated);
            return back()->with('success','category created');
    }
    public function update(Request $request,Category $category){
         $validated=$request->validate([
            'name'=>'required'
         ]);
         $category->update($validated);
         return back()->with('success','category updated');
    }
    public function destroy(Category $category){
        $category->delete();
        return back()->with('sccess','category deleted');
    }
}
