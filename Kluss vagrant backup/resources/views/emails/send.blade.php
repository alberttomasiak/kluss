<html>
<head></head>
<body style="background: black; color: white">
<h1>{{$title}}</h1>
<p>{{$content}}</p>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
</body>
</html>
