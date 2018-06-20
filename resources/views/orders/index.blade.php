
@extends('layouts.layout')

@section('title','订单管理')

@section('content')
	<!-- <h1>所有订单</h1> -->
	<div class="con_right storeorder">
		<h1 class="in_title">订单查询</h1>
		<form action="{{route('orders.index')}}" method="get" name="form">
			<div class="searchbox">
				<p>订单号</p>
				<input type="text" class="ordernum" value="123123123" name="order_id">
			</div>
			<div class="searchbox">
				<p>日期区间</p>
				<input type="text" readonly="readonly" class="demo-input ordernum laydate_2">
				<select class="orderstyle" name="status">
					<option value="1">下单</option>
					<option value="2">核销</option>
				</select>
			</div>
			<div class="searchbox" >
				<p>运动品类</p>
				<select class="orderstyle" name="type_id">
					@foreach($types as $type)
						<option value="{{$type->id}}">{{$type->name}}</option>
					@endforeach
				</select>
				<p class="fukuan1">付款类型</p>
				<select class="orderstyle fukuan2" name="pay_id">
					<option value="1">全部</option>
					<option value="2">线上预定</option>
					<option value="3">系统代收</option>
					<option value="4">线下付款</option>
				</select>
			</div>
			<a href="javascript:document.form.submit();" class="orderjian">检索</a>
			<a href="/export/orders" class="orderjian orderjian_r">导出当前数据</a>
		</form>
		
		<table border="1" class="table_line">
		    <tr>
		      <th>序号</th>
		      <th>订单号</th>
		      <th>价格</th>
		      <th>场馆</th>
		      <th>购买信息</th>
		      <th>购买时间</th>
		      <th>状态</th>
		    </tr>
			<?php foreach ($orders as $key => $order): ?>
					<tr>
				    <td>{{$key+1}}</td>
				    <td>{{$order->id}}</td>
				    <td>{{$order->total}}</td>
				    <th>{{$order->store->title}}</th>
				    <th>{{$order->client->nick_name}}</th>
				    <td>{{$order->created_at}}</td>
				    <th>{{$order->status->name}}</th>
			    </tr>
			<?php endforeach ?>
		</table>
		{{$orders->render()}}
	</div>
@stop
