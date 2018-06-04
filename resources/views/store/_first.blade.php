
{{-- @extends('layouts.layout')

@section('title','商家管理')

@section('content') --}}
	<div class="row">
		<div class="col-xs-12 in_box">
			<div class="alert" role="alert">
				<span class="in_title">商家管理</span>
			</div>
			<ul id="store_menu1" class="col-xs-12">
				<li @if($shadow == 1) class="active" @endif><a href="{{route('stores.edit',$store_id)}}">基础信息</a></li>
				<li @if($shadow == 2) class="active" @endif><a href="{{route('fields.index')}}">销售</a></li>
				<li @if($shadow == 3) class="active" @endif><a href="{{route('orders.create')}}">订单</a></li>
				<li @if($shadow == 4) class="active" @endif><a href="{{route('estimates.index')}}">评价</a></li>
			</ul>
		</div>
	</div>
{{-- 	<div class="row col-sm-12">
		@yield('substance')
	</div>
@stop --}}