@extends('layouts.app')

@section('title','Register')

@section('content')
<form  method="POST" action="">
    @csrf
    <input type="text" placeholder="Name" id="name" name="name">
    @error('name')
    <p>{{$message}}</p>
    @enderror
    <input type="email" placeholder="Email" id="email" name="email">
    @error('email')
    <p>{{$message}}</p>
    @enderror
    <input type="password" placeholder="Password" id="password" name="password">

    @error('password')
    <p>{{$message}}</p>
    @enderror
    <input type="password" placeholder="Password" id="password_confirmation" name="password_confirmation">


    <button type="submit">Send</button>
</form>

<h1>register</h1>

@endsection