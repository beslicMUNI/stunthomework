@extends('app')

@section('content')
<h1> Add employee</h1>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block alert-dismissible">
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block alert-dismissible">
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

<form action="/store-employee" method="POST">
    @csrf
    @method('POST')

    <div class="form-group">
        <input type="text" name="name" id="name" class="form-control" placeholder="Employee name">
        @error('name')
        <small class="text-danger">{{ $errors->first('name')}}</small>
        @enderror
    </div>

    <div class="form-group">
        <input type="email" name="email" id="email" class="form-control" placeholder="Employee email">
        @error('email')
        <small class="text-danger">{{ $errors->first('email')}}</small>
        @enderror
    </div>

    <div class="form-group">
        <input type="password" name="password" id="password" class="form-control" placeholder="Employee password">
        @error('password')
        <small class="text-danger">{{ $errors->first('password')}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="position">Position</label>
        <select name="positionid" id="postion" class="form-control">
            @foreach ($positions as $position)
            <option value="{{$position->id}}">{{$position->position_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="started_at">Job started at</label>
        <input type="date" name="started_at" id="started_at" class="form-control"><br>
        @error('started_at')
        <small class="text-danger">{{ $errors->first('started_at')}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="contract_type">Contract type</label>
        <select name="contract_type" id="contract_type" class="form-control">
            <option value="limited">Limited</option>
            <option value="unlimited">Unlimited</option>
        </select>
    </div>

    <input type="submit" value="Submit">


</form>

<a href="/admin">Back to admin dashboard</a>

@stop