@extends('app')

@section('content')
<p>Welcome! Please login to vacation application system</p>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

<form method="POST" action="/login">
    @csrf
    <input type="text" name="name" id="name" placeholder="Your name">
    <input type="password" name="password" id="password" placeholder="Your password">
    <input type="submit" value="Submit">
</form>
@stop