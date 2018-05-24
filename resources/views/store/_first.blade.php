
@extends('layouts.layout')

@section('title','商家管理')

@section('content')
	<div class="row">
		<div class="col-xs-12 in_box">
			<div class="alert" role="alert">
				<span class="in_title">商家管理</span>
			</div>
			<ul id="store_menu1" class="col-xs-12">
				<li class="active"><a href="{{route('stores.edit',1)}}">基础信息</a></li>
				<li><a href="{{route('items.index')}}">销售</a></li>
				<li><a href="{{route('orders.index')}}">订单</a></li>
				<li><a href="{{route('estimates.index')}}">评价</a></li>
			</ul>
		</div>
	</div>
	<div class="row col-sm-12">
		@yield('substance')
	</div>
@stop