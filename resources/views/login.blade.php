<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>登录</title>
<link href="css/admin/styles.css" rel="stylesheet">
<script src="js/admin/jquery-1.11.1.min.js"></script>
<!--[if lt IE 9]>
<script src="js/admin/html5shiv.js"></script>
<script src="js/admin/respond.min.js"></script>
<![endif]-->
</head>
<body>	
	<div class="row">
	@include('_messages')
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">奥运动管理员平台</div>
				<div class="panel-body">
					<form role="form" action="/login" method="post">
						{{ csrf_field() }}
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" >
							</div>
							<div class="checkbox">
							</div>
							<button class="btn btn-primary"  type="submit" >登录</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);
		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>
</html>
