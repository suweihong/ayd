@extends('layouts.layout')

@section('title','奥运动管理系统')

@section('content')
		<div class="row">
			<div class="col-xs-12 in_box">
				<div class="alert" role="alert">
					<span class="in_title">今日订单概览</span>
				</div>
				<div class="col-xs-4 in_pry1_item">
					<u class="in_pry1_item_u">565</u>
					<p class="in_pry1_item_p">下单数量</p>
				</div>
				<div class="col-xs-4 in_pry1_item">
					<u class="in_pry1_item_u">332</u>
					<p class="in_pry1_item_p">核销数量</p>
				</div>
				<div class="col-xs-4 in_pry1_item">
					<u class="in_pry1_item_u">0</u>
					<p class="in_pry1_item_p">退单数量</p>
				</div>
			</div>
			<div class="col-xs-12 in_box">
				<p class="alert" role="alert">财务概况  <a href="" class="in_box_item_a">今日</a>  <a href="" class="in_box_item_a">昨日</a>  <a href="" class="in_box_item_a">本月</a></p>
				<div class="col-xs-6 in_pry1_item">
					<u class="in_pry1_item_u">8000</u>
					<p class="in_pry1_item_p">销售总额</p>
				</div>
				<div class="col-xs-6 in_pry1_item">
					<u class="in_pry1_item_u">80</u>
					<p class="in_pry1_item_p">平均单价</p>
				</div>
			</div>
			<div class="col-xs-12 in_box">
				<p class="alert" role="alert">销售动态</p>
				@foreach($complaints as $complaint)
					<div class="col-xs-12 message_list">
						@if($complaint->check_id == 1)<p class="btn btn-fff">已读</p>
						@elseif($complaint->check_id == 2 && $complaint->client_id == '') <p class="btn btn-info">未读</p>
						@else<p class="btn btn-warning">投诉</p>
						@endif
						<p class="message_list_p">{{str_limit($complaint->content,$limit = 60, $end = '......')}}</p>
						<p class="message_list_p">{{$complaint->created_at->diffForHumans()}}</p>
					</div>
				@endforeach
			</div>
		</div>	
@endsection
