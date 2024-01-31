@extends('layouts.app')
  
@section('title','Login')

@section('content')



<form  method="POST">
     @csrf
    <input type="text" placeholder="Email"  id="email" name="email">
    <input type="password" placeholder="Password"  id="password" name="password">

	

    <button type="submit">Send</button>

	@error('message')
	<p>{{$message}}</p>

	@enderror
</form>

@endsection