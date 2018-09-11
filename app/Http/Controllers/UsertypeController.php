<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usertype;

class UsertypeController extends Controller
{
    /** usertypes table */
    public function index()
    {
        $usertypes = Usertype::all();
        return view('usertypes.index', compact('usertypes'));
    }

    /** usertype form */
    public function create()
    {
        $usertypes = Usertype::all();
        return view('usertypes.create', compact('usertypes'));
    }

    /** add usertype */
    public function store(Request $request)
    {
        //validate form
        $this->validate(request(), [
            'user_type'=>'required',
        ]);

        Usertype::create(request(['user_type']));

        $request->session()->flash('success_message', 'You have created a new User type!');
        
        return redirect('/usertypes');
    }

    /** update form */
    public function edit($id)
    {
        $usertype = Usertype::find($id);
        return view('usertypes.edit', compact('usertype'));
    }

    /** update usertype */
    public function update(Request $request, $id)
    {
        //validate form
        $this->validate(request(), [
            'user_type'=>'required',
        ]);

        Usertype::where('id', $id)->update(request(['user_type']));
        
        return redirect('/usertypes');
    }

    /** delete usertype */
    public function destroy($id)
    {
        Usertype::where('id', $id)->delete($id);
        
        return redirect('/usertypes');
    }
}
