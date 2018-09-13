<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feature;

class FeatureController extends Controller
{
    // features table
    public function index()
    {
        $features = Feature::all();
        return view('features.index', compact('features'));
    }

    // create form
    public function create()
    {
        $features = Feature::all();
        return view('features.create', compact('features'));
    }

    // add feature
    public function store(Request $request)
    {
        $this->validate(request(), [
            'feature_name'=>'required',
        ]);
        Feature::create(request([
            'user_id',
            'feature_name'  
        ]));
        // $request->session()->flash('success_message', 'You have created a new Feature');
        return redirect('/features');
    }

    // update form
    public function edit($id)
    {
        $feature = Feature::find($id);
        return view('features.edit', compact('feature'));
    }

    // update feature
    public function update(Request $request, $id)
    {
        //validate form
        $this->validate(request(), [
            'feature_name'=>'required'
        ]);
        Feature::where('id', $id)->update(request(['feature_name']));
        return redirect('/features');
    }

    // delete feature
    public function destroy($id)
    {
        Feature::where('id', $id)->delete($id);
        return redirect('/features');
    }

}
