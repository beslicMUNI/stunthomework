@extends('app')

@section('content')
<h3>Admin dashbord</h3>

<a href="/add-employee">Add employee</a> <br><br>


<table class="table table-stripped">
    <thead>
        <th>Employee</th>
        <th>From</th>
        <th>To</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($vacations as $vacation)
        <tr>
            <td>{{$vacation->user->name}}</td>
            <td>{{$vacation->date_from}}</td>
            <td>{{$vacation->date_to}}</td>
            <td>@if($vacation->confirmed)
                <button disabled>Confirmed</button>
                @else
                <a href="/vacation/confirm/{{$vacation->id}}">Confirm</a>
                @endif
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<a href="/logout">Logout</a>

@stop