<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>登录</title>
<link href="/css/style.css" type="text/css" media="screen" rel="stylesheet" />
<script src="/js/jquery-2.1.3.min.js"></script>
</head>
<body>	
	@include('_messages')
	<div class="loginbox">
		<div class="panel-heading">奥运动管理员平台</div>
		<div class="panel-body">
			<form role="form" action="/login" method="post">
				{{ csrf_field() }}
				<fieldset>
					<input class="form-control" placeholder="Password" name="password" type="password" value="" >
					<div class="checkbox"></div>
					<button class="loginBtn" type="submit">登录</button>
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>

