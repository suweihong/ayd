@extends('layouts.layout')

@section('title','订单管理')

@section('content')
	<!-- <h1>订单详情</h1> -->
	<div class="con_right storemanage">
		<h1 class="in_title">订单详情</h1>
		<p class="order_details">订单号：15522</p>
		<p class="order_details">场馆：奇乐健身中心</p>
		<p class="order_details">订单信息：4月25日场地1</p>
		<p class="order_details">购买人: 张三</p>
		<p class="order_details">联系电话：13091231233</p>
		<p class="order_details">核销状态：未审核</p>
		<button  class="order_detailsbtn">协助核销</button>
		<p class="order_details"><a href="javascript:;" class="btnorder_details">返回</a></p>
	</div>
@stop