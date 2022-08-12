<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.5.2-1/css/bootstrap-rtl.min.css" integrity="sha512-+1C9xBCl0azgGjU6bIsATfB4XOQ0MSFduPs388NiyzwYt4nfelS72KSPSFZT338FjP7F3mMme2re8+gUJe2HZQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('public/css/app.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Images</title>
</head>
<body>

<div class="row" id="fileBrowse">
    @foreach($fileNames as $path)
    <div class="col-md-3">
        <div class="img-thumbnail">
            <img src="{{asset('storage/app/images/'.$path)}}" alt="" class="w-100 img-fluid">
        </div>
    </div>
        @endforeach
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.5.2-1/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>
<script src="{{asset('public/js/app.js')}}"></script>
</body>
</html>