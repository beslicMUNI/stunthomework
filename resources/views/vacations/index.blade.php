@extends('app')

@section('content')


<h3>Welcome, {{Auth::user()->name}}</h3>
<p>Plan your vacations</p>

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

<form action="/store-vacation" method="POST">
    @csrf
    @method('post')

    <label for="date_from">From</label>
    <input type="date" name="date_from" id="date_from">

    <label for="date_to">To</label>
    <input type="date" name="date_to" id="date_to">

    <input type="submit" value="Submit">
</form>
<br> <br>
<h5>Your vacations</h5>
<table class="table table-stripped">
    <thead>
        <th>From</th>
        <th>To</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($user->vacations as $vacation)
        <tr>
            <td>{{$vacation->date_from}}</td>
            <td>{{$vacation->date_to}}</td>
            <td>@if($vacation->confirmed)
                confirmed
                @else
                NOT CONFIRMED
                @endif
            </td>
        </tr>
        @endforeach


    </tbody>
</table>


<a href="/logout">Logout</a>

@stop