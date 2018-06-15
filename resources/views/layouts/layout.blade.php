<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>@yield('title','奥运动')</title>
		{!! we_css() !!}
   		{!! we_js() !!}
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon"/>
	<link href="/css/style.css" type="text/css" media="screen" rel="stylesheet"/>
	<link href="/font/iconfont.css" type="text/css" media="screen" rel="stylesheet"/>
	<script src="/js/laydate/laydate.js"></script>
	<script src="/js/jquery-2.1.3.min.js"></script>
</head>
<body>
	<div class="topper">
		<div class="topper_l">
			奥运动管理员平台
		</div>
		<div class="topper_r">
			<a href="javascript:;">上次登录：{{$_SESSION['last_time']}}</a>
			<a href="/logout">退出登录</a>
		</div>
	</div>
	<div class="content">
		<ul class="con_left">
			<li class="menulist0"></li>
	        <li class="menulist1"></li>
	        <li class="menulist hover">
	        	<img src="/img/pencil.png" class="menuimg">
	            <a href="/" class="menutxt">系统概览</a>
	        </li>
	        <li class="menulist">
	        	<div class="menu_msg hover">
		        	<img src="/img/xia.png" class="menuimg_x">
		        	<img src="/img/you.png" class="menuimg_y">
		            <a href="javascript:;" class="menutxt">核心系统</a>
		        </div>
	            <ul class="menulist_u">
	            	<li class="hover">
			        	<img src="/img/you.png" class="menuimg">
			            <a href="{{route('advertisements.index')}}" class="menutxt">广告管理</a>
	            	</li>
	            	<li class="hover">
			        	<img src="/img/you.png" class="menuimg">
			            <a href="{{ route('types.index')}}" class="menutxt">运动品类</a>
	            	</li>
	            	<li class="hover">
			        	<img src="/img/you.png" class="menuimg">
			            <a href="{{ route('stores.index')}}" class="menutxt">商家管理</a>
	            	</li>
	            </ul>
	        </li>
	        <li class="menulist">
	        	<div class="menu_msg hover">
		        	<img src="/img/xia.png" class="menuimg_x">
		        	<img src="/img/you.png" class="menuimg_y">
		            <a href="javascript:;" class="menutxt">订单查询</a>
	            </div>
	            <ul class="menulist_u">
	            	<li class="hover">
			        	<img src="/img/you.png" class="menuimg">
			            <a href="{{route('orders.index')}}" class="menutxt">所有订单</a>
	            	</li>
	            	<li class="hover">
			        	<img src="/img/you.png" class="menuimg">
			            <a href="{{route('orders.create')}}" class="menutxt">按商家</a>
	            	</li>
	            	<li class="hover">
			        	<img src="/img/you.png" class="menuimg">
			            <a href="{{route('orders.edit',1)}}" class="menutxt">按用户</a>
	            	</li>
	            	<li class="hover">
			        	<img src="/img/you.png" class="menuimg">
			            <a href="{{route('orders.show',1)}}" class="menutxt">订单详情</a>
	            	</li>
	            </ul>
	        </li>
	        <li class="menulist hover">
	        	<img src="/img/pencil.png" class="menuimg">
	            <a href="{{ route('bills.index')}}" class="menutxt">财务对账</a>
	        </li>
	        <li class="menulist">
	        	<div class="menu_msg hover">
		        	<img src="/img/xia.png" class="menuimg_x">
		        	<img src="/img/you.png" class="menuimg_y">
		            <a href="javascript:;" class="menutxt">服务中心</a>
		        </div>
	            <ul class="menulist_u">
	            	<li class="hover">
			        	<img src="/img/you.png" class="menuimg">
			            <a href="{{route('complaints.index',1)}}" class="menutxt">商家反馈</a>
	            	</li>
	            	<li class="hover">
			        	<img src="/img/you.png" class="menuimg">
			            <a href="{{ route('complaints.index',2)}}" class="menutxt">用户投诉</a>
	            	</li>
	            	<li class="hover">
			        	<img src="/img/you.png" class="menuimg">
			            <a href="{{ route('notices.index')}}" class="menutxt">公告</a>
	            	</li>
	            </ul>
	        </li>
	        <li class="menulist hover">
	        	<img src="/img/pencil.png" class="menuimg">
	            <a href="{{route('estimates.index')}}?check_id=3" class="menutxt">评价审核</a>
	        </li>
	    </ul>
		@yield('content')
	</div>
	<script type="text/javascript">
		$('.form_name_newadd').click(function(){
			$('.mask_codebox').fadeIn()
		})
		$('.form_name_close').click(function(){
			$('.mask_codebox').fadeOut()
		})
		$('.starflist_item,.storesale_place a').hover(function(){
			$(this).find('.masked').stop().fadeIn()
		},function(){
			$(this).find('.masked').stop().fadeOut()
		})
		$('.menu_msg').click(function(){
			$(this).siblings('.menulist_u').slideToggle()
		})
		function tabs(e){
			if(e==1){
				$('.in_pry2box_content_show1').show().siblings().hide()
			}else{
				$('.in_pry2box_content_show2').show().siblings().hide()
			}
		}
		$('.in_pry2box_tab li').click(function(){
			$(this).removeClass('in_pry2box_tab_0').addClass('in_pry2box_tab_1').siblings('li').removeClass('in_pry2box_tab_1').addClass('in_pry2box_tab_0')
		})
		function salestyle(e){
			if(e==1){
				$('#saletay').hide()
			}else{
				$('#saletay').show()
			}
		}
		//删除提示框
		function btnClick(id){
			$('.del_prompt').css('display','block') ;
			$('.message_del').attr('data_id',id);
			$('.del_cancle').click(function(){
				$('.del_prompt').css('display','none') ;
			})
		};
	</script>
</body>
</html>
