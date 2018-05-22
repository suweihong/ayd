<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<link href="css/admin/bootstrap.min.css" rel="stylesheet">
<link href="css/admin/datepicker3.css" rel="stylesheet">
<link href="css/admin/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/admin/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/admin/html5shiv.js"></script>
<script src="js/admin/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><span>奥运动管理员平台</span></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"></svg> 上次登录：{{ $last_time }} </a>
						<a href="/logout" class="dropdown-toggle" ><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> 退出登录</a>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
			<!-- 	<input type="text" class="form-control" placeholder="Search"> -->
			</div>
		</form>
		<ul class="nav menu">
			
				<li class="menulist"><a href="/"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> 系统概览</a></li>
				<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 核心系统 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="{{route('advertisements.index')}}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> 广告管理
						</a>
					</li>
					<li>
						<a class="" href="{{ route('types.index')}}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> 运动品类
						</a>
					</li>
					<li>
						<a class="" href="{{ route('stores.index')}}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> 商家管理
						</a>
					</li>
				</ul>
			</li>
			<li class="parent ">
				<a href="">
					<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 订单查询 
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="{{route('orders.index')}}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> 所有订单
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> 按商家
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> 按用户
						</a>
					</li>
				</ul>
			</li>
			<li class="parent ">
				<a href="{{ route('bills.index')}}">
					<span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg></span> 财务对账 
				</a>
			</li>
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-4"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 服务中心 
				</a>
				<ul class="children collapse" id="sub-item-4">
					<li>
						<a class="" href="{{route('messages.index')}}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> 商家反馈
						</a>
					</li>
					<li>
						<a class="" href="{{ route('messages.index')}}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> 用户投诉
						</a>
					</li>
					<li>
						<a class="" href="{{ route('notices.index')}}">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> 公告
						</a>
					</li>
				</ul>
			</li>	
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-5"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg></span> 评价审核 
				</a>
			</li>
		
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		@yield('content')
		
	
	</div><!--/.main-->			
	
	<script src="js/admin/jquery-1.11.1.min.js"></script>
	<script src="js/admin/bootstrap.min.js"></script>
	<script src="js/admin/chart.min.js"></script>
	{{-- <script src="js/admin/chart-data.js"></script> --}}
	<script src="js/admin/easypiechart.js"></script>
	{{-- <script src="js/admin/easypiechart-data.js"></script> --}}
	<script src="js/admin/bootstrap-datepicker.js"></script>

	<script>
		// $('#calendar').datepicker({
		// });

		(function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){
		        $(this).find('em:first').toggleClass("glyphicon-minus");
		    });
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery));

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
		

	</script>
</body>

</html>
