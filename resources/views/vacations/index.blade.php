<p>Plan your vacations</p>

<form action="/store-vacation" method="POST">
    @csrf
    @method('post')

    <label for="date_from">From</label>
    <input type="date" name="date_from" id="date_from">

    <label for="date_to">To</label>
    <input type="date" name="date_to" id="date_to">

    <input type="submit" value="Submit">
</form>