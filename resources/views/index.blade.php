
@extends('layouts.layout')

@section('title','奥运动管理系统')

@section('content')
<div class="con_right">
	<div class="con_rightbox">
    	<h1 class="in_title">今日订单概览</h1>
		<div class="in_box">
			<a href="{{route('orders.index')}}?state=100" class="in_item">
				<u class="in_item_u">{{$num_x}}</u>
				<p class="in_item_p">下单数量</p>
			</a>
			<a href="{{route('orders.index')}}?state=1" class="in_item">
				<u class="in_item_u">{{$num_h}}</u>
				<p class="in_item_p">核销数量</p>
			</a>
			<a href="{{route('orders.index')}}?state=2" class="in_item">
				<u class="in_item_u">{{$num_t}}</u>
				<p class="in_item_p">退单数量</p>
			</a>
		</div>
	</div>
	<div class="con_rightbox">
    	<h1 class="in_title">
    		财务概况
    		<a class="in_title_date" href="javascript:;">今日</a>
    		<a class="in_title_date" href="javascript:;">昨日</a>
    		<a class="in_title_date" href="javascript:;">本月</a>
    	</h1>
		<div class="in_box">
			<a href="javascript:;" class="in_item">
				<u class="in_item_u">8000</u>
				<p class="in_item_p">销售总额</p>
			</a>
			<a href="javascript:;" class="in_item">
				<u class="in_item_u">80</u>
				<p class="in_item_p">平均单价</p>
			</a>
		</div>
	</div>
	<div class="con_rightbox">
    	<h1 class="in_title">消息动态</h1>
		<ul class="in_boxt">
			@foreach($complaints as $complaint)
				<li  class="in_box_line">
					@if($complaint->check_id == 1)<p class="btn_y">已读</p>
					@elseif($complaint->check_id == 2 && $complaint->client_id == '')<p class="btn_n">未读</p>
					@else<p class="btn_request">投诉</p>
					@endif
					<p>{{str_limit($complaint->content,$limit = 60, $end = '......')}}</p>
					<p>{{$complaint->created_at->diffForHumans()}}</p>
				</li>
			@endforeach
		</ul>
	</div>
</div>
@endsection