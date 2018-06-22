
@extends('layouts.layout')

@section('title','订单管理')

@section('content')
	<div class="con_right storeorder">
		@include ('_messages')
		<h1 class="in_title">订单查询</h1>
		<form action="{{route('orders.index')}}" method="get" name="form">
			<input type="hidden" name="search" value="1">
			<div class="searchbox">
				<p>订单号</p>
				<input type="text" class="ordernum" value="{{old('order_id')}}" name="order_id">
			</div>
			<div class="searchbox">
				<p>日期区间</p>
				<input type="text" readonly="readonly" class="demo-input ordernum laydate_2" name="date">
				<select class="orderstyle" name="status">
					@foreach($status_list as $statu)
						<option value="{{$statu->id}}">{{$statu->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="searchbox" >
				<p>运动品类</p>
				<select class="orderstyle" name="type_id">
					<option value="0">全部</option>
					@foreach($types as $type)
						<option value="{{$type->id}}">{{$type->name}}</option>
					@endforeach
				</select>
				<p class="fukuan1">付款类型</p>
				<select class="orderstyle fukuan2" name="pay_id">
					<option value="0">全部</option>
					@foreach($payment as $pay)
					    <option value="{{$pay->id}}">{{$pay->name}}</option>
					@endforeach
				</select>
			</div>
			<a href="javascript:document.form.submit();" class="orderjian">检索</a>
			@if($search == 1)
				<a href="/export/orders?search=1" class="orderjian orderjian_r">导出当前数据</a>
			@else
				<a href="/export/orders" class="orderjian orderjian_r">导出当前数据</a>

			@endif
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
		      <th>订单管理</th>
		    </tr>
		
			<?php foreach ($orders as $key => $order): ?>
				<tr>
				    <td>{{$key+1}}</td>
				        <td>{{$order->id}}</td>
				        <td>{{$order->total}}</td>
				        <td>{{$order->store->title}}【{{$order->type->name}}】</td>
				        <td>{{$order->client->nick_name}}</td>
				        <td>{{$order->created_at}}</td>
				  		<td>{{$order->new_status()->name}}</td>
				    	<td><a href="{{route('orders.show',$order->id)}}">查看详情</a></td>
			    </tr>
			<?php endforeach ?>
		  
		</table>
		@if($search == 2)
        	{{ $orders->render()}}
        @endif
	</div>
@stop
