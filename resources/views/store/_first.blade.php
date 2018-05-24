
@extends('layouts.layout')

@section('title','商家管理')

@section('content')
	<div>
		<a href="{{route('stores.edit',1)}}">基础信息</a>
		<a href="{{route('items.index')}}">销售</a>
		<a href="{{route('orders.index')}}">订单</a>
		<a href="{{route('estimates.index')}}">评价</a>
	 </div>
	<div class="row col-sm-12">
		@yield('substance')
	</div>
@stop