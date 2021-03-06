
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
    		<a  @if($time == 1) class="in_title_date decration" @else class="in_title_date" @endif  href="/?time=1">今日</a>
    		<a @if($time == 2) class="in_title_date decration" @else class="in_title_date" @endif href="/?time=2">昨日</a>
    		<a @if($time == 3) class="in_title_date decration" @else class="in_title_date" @endif href="/?time=3">本月</a>
    	</h1>
    	@if($time == 1)
			<div class="in_box">
				<a href="javascript:;" class="in_item">
					<u class="in_item_u">{{$t_total}}</u>
					<p class="in_item_p">销售总额</p>
				</a>
				<a href="javascript:;" class="in_item">
					<u class="in_item_u">{{$t_avg}}</u>
					<p class="in_item_p">平均单价</p>
				</a>
			</div>
		@elseif($time == 2)
			<div class="in_box">
				<a href="javascript:;" class="in_item">
					<u class="in_item_u">{{$y_total}}</u>
					<p class="in_item_p">销售总额</p>
				</a>
				<a href="javascript:;" class="in_item">
					<u class="in_item_u">{{$y_avg}}</u>
					<p class="in_item_p">平均单价</p>
				</a>
			</div>
		@elseif($time == 3)
			<div class="in_box">
				<a href="javascript:;" class="in_item">
					<u class="in_item_u">{{$m_total}}</u>
					<p class="in_item_p">销售总额</p>
				</a>
				<a href="javascript:;" class="in_item">
					<u class="in_item_u">{{$m_avg}}</u>
					<p class="in_item_p">平均单价</p>
				</a>
			</div>
		@else
			<div class="in_box">
				<a href="javascript:;" class="in_item">
					<u class="in_item_u">{{$total}}</u>
					<p class="in_item_p">销售总额</p>
				</a>
				<a href="javascript:;" class="in_item">
					<u class="in_item_u">{{$total_avg}}</u>
					<p class="in_item_p">平均单价</p>
				</a>
			</div>
		@endif
	</div>
	<div class="con_rightbox">
    	<h1 class="in_title">消息动态</h1>
		<ul class="in_boxt">
			@foreach($complaints as $complaint)
			<li class="in_box_line">
				<a @if($complaint->client_id == '') href="/types/1/complaints/{{$complaint->id}}" @elseif($complaint->mp_user_id == '') href="/types/2/complaints/{{$complaint->id}}" @endif  class="btn_a">
					@if($complaint->check_id == 1)
						<p class="btn_y">已读</p>
					@elseif($complaint->check_id == 2 && $complaint->client_id == '')
						<p class="btn_n">未读</p>
					@else
						<p class="btn_request">投诉</p>
					@endif
					<p>{{str_limit($complaint->content,$limit = 60, $end = '......')}}</p>
					<p class="btn_time">{{$complaint->created_at->diffForHumans()}}</p>
				</a> 
			</li>
			@endforeach
		</ul>
	</div>
</div>

@endsection