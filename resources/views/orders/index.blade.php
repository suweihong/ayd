
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
<<<<<<< HEAD
				<input type="text" readonly="readonly" class="demo-input ordernum laydate_2">
=======
				<input type="text" class="ordernum" value="{{old('date')}}" name="date">
>>>>>>> cbbdbca79150572d0799f36974a7324eef72961c
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
				    @if($search == 2)
				        <td>{{$order->id}}</td>
				        <td>{{$order->total}}</td>
				        <td>{{$order->store->title}}【{{$order->type->name}}】</td>
				        <td>{{$order->client->nick_name}}</td>
				    @else
                        <td>{{$order->order_id}}</td>
                        <td>{{$order->order->total}}</td>
                        <td>{{$order->order->store->title}}【{{$order->order->type->name}}】 </td>
                        <td>{{$order->order->client->nick_name}}</td>
				    @endif
				   
				    <td>{{$order->created_at}}</td>
				    @if($search == 2)
				         <td>{{$order->new_status()->name}}</td>
				    @else
				        <td>{{$order->status->name}}</td>
				    @endif
			    </tr>
			<?php endforeach ?>
		  
		</table>
        {{ $orders->render()}}
	</div>
@stop
