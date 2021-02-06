@extends('layouts.app')

@section('content')
{{ @csrf_field() }}
<div class="row" style="margin-top: 25px;">
	<div class="col l6 offset-l3 m10 offset-m1 s12">
		<div class="btn-new-container center">
  		<button class="btn-flat waves-light waves-effect blue lighten-1 white-text" onclick="addTodo()">
  			Add new Todo
  		</button>	
		</div>
		<ul class="collection with-header">
      <li class="collection-header center"><h5><i class="fa fa-list blue-text"></i></h5></li>
      <div id="todo-items-container">

      </div>
      @if($todos->count() > 5)
	      <li class="collection-item view-more">
	      	<button class="btn btn-flat waves-effect waves-light blue lighten-1 white-text btn-view-more" style="width: 100%">
	      		<i class="fa fa-angle-down"></i>
	      	</button>
	      </li>
      @endif
    </ul>
	</div>
</div>
@endsection

@section('scripts')
  <script src="/js/todo.js"></script>	
@endsection