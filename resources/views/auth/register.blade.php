@extends('layouts.app')

@section('content')
	<div class="row" style="margin-top: 25px;">
		<div class="col l4 offset-l4 m10 offset-m1 s12">
			<form method="post" action="{{ route('register-user') }}" autocomplete="off">
				{{ @csrf_field() }}
				<ul class="collection with-header">
	        <li class="collection-header center"><h4>Register</h4></li>
	        @error('name')
           <li class="collection-item red lighten-1 white-text">{{ $message }}</li>
          @enderror
	        <li class="collection-item">
	        	<div class="input-field">
	        		<i class="fa fa-user prefix"></i>
	        		<label for="name">Name</label>
	        		<input type="text" name="name" required>
	        	</div>
	        </li>
	        @error('email')
           <li class="collection-item red lighten-1 white-text">{{ $message }}</li>
          @enderror
	        <li class="collection-item">
	        	<div class="input-field">
	        		<i class="fa fa-envelope prefix"></i>
	        		<label for="email">Email</label>
	        		<input type="email" name="email" required>
	        	</div>
	        </li>
	        @error('password')
           <li class="collection-item red lighten-1 white-text">{{ $message }}</li>
          @enderror
	        <li class="collection-item">
	        	<div class="input-field">
	        		<i class="fa fa-lock prefix"></i>
	        		<label for="password">Password</label>
	        		<input type="password" name="password" required>
	        	</div>
	        </li>
	        @error('password_confirmation')
           <li class="collection-item red lighten-1 white-text">{{ $message }}</li>
          @enderror
	        <li class="collection-item">
	        	<div class="input-field">
	        		<i class="fa fa-lock prefix"></i>
	        		<label for="password">Password Confirmation</label>
	        		<input type="password" name="password_confirmation" required>
	        	</div>
	        </li>
	        <li class="collection-item">
	        	<div class="input-field">
	        		<button class="btn btn-flat waves-effect waves-light white-text blue lighten-1" style="width: 100%" type="submit">
	        			Register
	        		</button>
	        	</div>
	        </li>
	      </ul>	
			</form>
		</div>
	</div>
@endsection