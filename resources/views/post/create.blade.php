<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>this is a post create </h1>
@if($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
@endif
{{$errors->login->first('email')}}
</body>
</html>