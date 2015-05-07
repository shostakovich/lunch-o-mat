<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Mystery Lunch</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="l-wrapper">
	    @include('partials/_flash')
	    @yield('content')
    </div>
</body>
</html>
