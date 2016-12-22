<form method="POST" action="users1">
{!! csrf_field() !!}
<div><label>Firstname</label>
<input type="text" name="name"></div>
<div><label>Email</label>
<input type="text" name="email"></div>
<div><label>Password</label>
<input type="password" name="password"></div>

<input type="submit" value="Create">

</form>