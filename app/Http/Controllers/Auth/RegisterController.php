<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
  public function index()
  {
  	return view('auth.register');
  }

  public function create(Request $request)
  {
  	$this->validate($request, [
  		'name' => 'required|unique:users,name',
    	'email' => 'required|unique:users,email',
      'password' => 'required|confirmed'
  	]);

  	$user = User::create($request->except('password') + [
  		'password' => Hash::make($request->password)
  	]);
    auth()->attempt($request->only('email', 'password'));
  	return redirect()->route('todo');
  }
}
