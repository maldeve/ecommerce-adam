<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_Feature;
use App\Product;
use App\Feature;


class Product_FeatureController extends Controller
{
    // authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    // product_features
    public function productFeatures($id)
    {
        $product = Product::find($id);
        $features = Feature::all();
        $product_features = Product_Feature::all();
        return view('product_features.create', compact(['product', 'features', 'product_features']));
    }
    
    // create product_feature
    public function store(Request $request)
    {
        //validate form
        $this->validate(request(), [
            'product_id'=>'required',
            'feature_id'=>'required',
            'specifications'=>'required'
        ]);
        Product_Feature::create(request(['product_id', 'feature_id', 'specifications']));
        return back();
    }

    // update product_feature
    public function update(Request $request, $id)
    {
        //validate form
        $this->validate(request(), [
            'specifications'=>'required',
        ]);
        Product_Feature::where('id', $id)->update(request(['specifications']));
        return back();
    }

    // delete product_feature
    public function destroy($id)
    {
        Product_Feature::where('id', $id)->delete($id);
        return back();
    }
}
