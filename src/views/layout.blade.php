<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<title>@yield('title')</title>
	<style>
		ul {
			list-style-type: none;
			padding-left: 0;
		}
		li:hover {
			background-color: #eee;
		}
		.hide {
			display: none;
		}
	</style>
</head>
<body>
	<div class="container">
		<h2>@yield('title')</h2>
		@yield('content')
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	@yield('script')
</body>
</html>
