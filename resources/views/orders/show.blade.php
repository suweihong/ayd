@extends('layouts.layout')

@section('title','订单管理')

@section('content')
	<!-- <h1>订单详情</h1> -->
	<div class="con_right storemanage">
		<h1 class="in_title">订单详情</h1>
		<p class="order_details">订单号：{{$orders->id}}</p>
		<p class="order_details">场馆：{{$orders->store->title}}</p>
		<p class="order_details">订单信息：{{$orders->date->format('Y年m月d日')}}场地1</p>
		<p class="order_details">购买人: {{$orders->client->nick_name}}</p>
		<p class="order_details">联系电话：{{$orders->phone}}</p>
		<p class="order_details">核销状态：{{$orders->new_status()->name}}</p>
		<button  class="order_detailsbtn">协助核销</button>
		<p class="order_details"><a href="javascript:history.back(-1)" class="btnorder_details">返回</a></p>
	</div>
@stop