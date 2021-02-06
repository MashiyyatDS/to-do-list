<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
	public function todosJSON()
	{
		$todos = auth()->user()->todos()->orderBy('created_at','DESC')->paginate(5);
		return response()->json(['todos' => $todos]);
	}

  public function create(Request $request)
  {
  	$todo = auth()->user()->todos()->create($request->all());
  	return response()->json(['todo' => $todo]);
  }

  public function find($id)
  {
  	$todo = Todo::find($id);
  	return response()->json(['todo' => $todo]);
  }

  public function update(Request $request, $id)
  {
  	$todo = Todo::find($id);
    $todo->update($request->except('user_id') + ['user_id' => auth()->user()->id]);
  	return response()->json(['todo' => $todo]);
  }

  public function markComplete($id)
  {
  	$todo = Todo::find($id);
  	$todo->update(['isCompleted' => true]);
  	return response()->json(['todo' => $todo]);
  }

  public function delete($id)
  {
  	$todo = Todo::find($id);
  	$todo->delete();
  }

}
