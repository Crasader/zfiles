<html>

<head>

</head>

<body>

<form action="{{ url('uploadFile') }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input name="file" type="file">

    <input type="submit" value="Upload">
</form>
</body>
</html>