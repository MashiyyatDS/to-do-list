@extends('layouts.app')

@section('content')
	<div class="row" style="margin-top: 25px;">
		<div class="col l4 offset-l4 m10 offset-m1 s12">
			@if(session('status'))
        <ul class="collection center">
		      <li class="collection-item red lighten-1 white-text">{{ session('status') }}</li>
		    </ul>
      @endif
			<form method="post" action="{{ route('login-user') }}" autocomplete="off">
				{{ @csrf_field() }}
				<ul class="collection with-header">
	        <li class="collection-header center"><h4>Login</h4></li>
	        <li class="collection-item">
	        	<div class="input-field">
	        		<i class="fa fa-envelope prefix"></i>
	        		<label for="email">Email</label>
	        		<input type="email" name="email" required value="{{ old('email') }}">
	        	</div>
	        </li>
	        <li class="collection-item">
	        	<div class="input-field">
	        		<i class="fa fa-lock prefix"></i>
	        		<label for="password">Password</label>
	        		<input type="password" name="password" required>
	        	</div>
	        	<p>
	            <input type="checkbox" id="remember_me" name="remember_me" />
	            <label for="remember_me">Remember me</label>
	          </p>
	        </li>
	        <li class="collection-item">
	        	<div class="input-field">
	        		<button class="btn btn-flat waves-effect waves-light white-text blue lighten-1" style="width: 100%" type="submit">
	        			Login
	        		</button>
	        	</div>
	        </li>
	      </ul>	
			</form>
		</div>
	</div>
@endsection