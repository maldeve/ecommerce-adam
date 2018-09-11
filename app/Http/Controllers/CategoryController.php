<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /** index page*/
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**create form */
    public function create()
    {
        $categories = Category::all();
        return view('categories.create', compact('categories'));
    }

    /** create category */
    public function store(Request $request)
    {
        //validate form
        $this->validate(request(), [
            'category_name'=>'required',
        ]);

        Category::create(request(['category_type','category_name']));

        $request->session()->flash('success_message', 'You have created a new Category...');
        
        return redirect('/categories');
    }

    /** update form */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    /** update category */
    public function update(Request $request, $id)
    {
        //validate form
        $this->validate(request(), [
            'category_type'=>'required',
            'category_name'=>'required',
        ]);

        Category::where('id', $id)->update(request(['category_type', 'category_name']));
        
        return redirect('/categories');
    }

    /** delete category */
    public function destroy($id)
    {
        Category::where('id', $id)->delete($id);
        
        return redirect('/categories');
    }
}
