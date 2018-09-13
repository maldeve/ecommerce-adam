<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Auth;
use App\Product;

class ProductController extends Controller
{
    // products table 
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // create form 
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // add product 
    public function store(Request $request)
    {
        $this->validate(request(), [
            'category_id'=>'required',
            'product_name'=>'required',
            'product_price'=>'required',
            'product_description'=>'required',
            'product_status'=>'required',
        ]);
        Product::create(request([
            // 'user_id',
            'category_id',
            'product_name',
            'product_price',
            'product_description',
            'product_status'   
        ]));
        // $request->session()->flash('success_message', 'You have created a new Product');
        return redirect('/products');
    }

    // update form 
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    // update product 
    public function update(Request $request, $id)
    {
        //validate form
        $this->validate(request(), [
            'product_name'=>'required',
            'product_price'=>'required',
            'product_description'=>'required',
            'product_status'=>'required',
        ]);
        Product::where('id', $id)->update(request(['product_name', 'product_price', 'product_description', 'product_status']));
        return redirect('/products');
    }

    // delete product 
    public function destroy($id)
    {
        Product::where('id', $id)->delete($id);
        return redirect('/products');
    }

}
