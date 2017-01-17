<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Validator;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::firstOrCreate(['id' => 1]);

        $data = ['user' => $user];

        return view('account', $data);
    }

    public function update_email(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $destinationPath = "images";
            $filename=str_random(10).'.'.$file->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $filename);
            $user->image = $destinationPath.'/'.$filename;
        }

        $user->save();

        $request->session()->flash('edit_success', 'Account successfully edited!');

        return redirect(route('account'));

    }

    public function update_password(Request $request, $id)
    {
        $this->validate($request, [
            'old_password' => 'required|old_password',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::find($id);

        $user->password = bcrypt($request->password);
        $user->save();

        $request->session()->flash('edit_success', 'password successfully edited!');

        return redirect(route('account'));

    }
}
