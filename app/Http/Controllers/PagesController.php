<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class PagesController extends Controller
{
  public function index()
  {
    if(auth()->user()) {
      return redirect()->route('todo');
    }else {
      return view('pages.index');
    }
  }

  public function todo()
  {
  	$todos = auth()->user()->todos()->get();
  	return view('pages.todo',[
  		'todos' => $todos
  	]);
  }
}
