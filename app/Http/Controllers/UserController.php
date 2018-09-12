<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /** users table */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /** create form */
    public function create()
    {
        //
    }

    /** update form */
    public function edit($id)
    {
        //
    }

    /** update user */
    public function update(Request $request, $id)
    {
        //
    }

    /** delete user */
    public function destroy($id)
    {
        User::where('id', $id)->delete($id);
        return redirect('/users');
    }
}
