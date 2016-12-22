<!DOCTYPE html>
<html>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

<body>


<form action="formtest" method="post" enctype="multipart/form-data">
{{csrf_field()}}
<div ng-app="">
<label>Name</label><br>
<input type="text" placeholder="Name" ng-model="name"><br>
<p ng-bind="name"></p> </div>
<label>Email Address</label><br>
<input type="text" placeholder="email" name="email"><br>
<label>Password</label><br>
<input type="password" placeholder="password" name="password"><br>
<label>Avatar</label><br>
<input type="file" name="imagefile">
<br><input type="submit" name="submit" value="Submit">
</form>
</body>
</html>