<form action="/store-employee" method="POST">
    @csrf
    @method('POST')
    <input type="text" name="name" id="name" placeholder="Employee name"><br>
    @error('name')
    <small class="text-danger">{{ $errors->first('name')}}</small>
    @enderror

    <input type="email" name="email" id="email" placeholder="Employee email"><br>
    @error('email')
    <small class="text-danger">{{ $errors->first('email')}}</small>
    @enderror

    <input type="password" name="password" id="password" placeholder="Employee password"><br>
    @error('password')
    <small class="text-danger">{{ $errors->first('password')}}</small>
    @enderror

    <label for="position">Position</label>
    <select name="positionid" id="postion">
        @foreach ($positions as $position)
        <option value="{{$position->id}}">{{$position->position_name}}</option>
        @endforeach
    </select>
    <label for="started_at">Job started at</label>
    <input type="date" name="started_at" id="started_at"><br>
    @error('started_at')
    <small class="text-danger">{{ $errors->first('started_at')}}</small>
    @enderror

    <label for="contract_type">Contract type</label>
    <select name="contract_type" id="contract_type">
        <option value="limited">Limited</option>
        <option value="unlimited">Unlimited</option>
    </select>

    <input type="submit" value="Submit">


</form>