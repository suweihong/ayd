@extends('layouts.layout')

@section('title','订单管理')

@section('content')
	<!-- <h1>按商家订单</h1> -->
	<div class="con_right storemanage">
		@include('_messages')
		@include('store._first',['shadow'=>3,'store_id'=>$store->id])
		<form action="/store/orders" method="get" name="form">
			<div class="search">
				<input type="hidden"  name="search" value="1">
				<input type="hidden" name="store_id" value="{{$store->id}}">
				<input class="searchstyle" type="text" placeholder="订单号" name="order_id" value="{{$order_id}}">
				<input type="text" readonly="readonly" class="demo-input searchstyle2 laydate_2" name="date" value="{{$now}}">
				<select class="searchstyle searchstyle_w" name="status">
					@foreach($status_list as $st)
					    <option value="{{$st->id}}" @if($st->id == $status) selected="selected" @endif>
					    	{{$st->name}}
					    </option>
					@endforeach	
				</select>
				<select class="searchstyle searchstyle_w" name="type_id">
					<option value="0">全部</option>
					@foreach($store_types as $type)
					    <option value="{{$type->id}}" @if($type->id == $type_id) selected="selected" @endif>{{$type->name}}</option>
					@endforeach	
				</select>
				<a href="javascript:document.form.submit();" class="search_jian">检索</a>
				@if($search == 1)
					<a href="/export/orders?search=1" class="search_add_out">导出当前数据</a>

				@else
					<a href="/export/orders?store_id={{$store_id}}" class="search_add_out">导出当前数据</a>
				@endif
		    </div>                                                       
		</form>
		<p class="changguan">场馆：{{$store->title}}</p>
		<table border="1" class="table_line">
		    <tr>
		      <th>序号</th>
		      <th>订单号</th>
		      <th>销售价格</th>
		      <th>场馆</th>
		      <th>购买信息</th>
		      <th>购买时间</th>
		      <th>状态</th>
		      <th>订单管理</th>
		    </tr>
		    @foreach($orders as $k => $order)
		        <tr>
		        	<td>{{$k+1}}</td>
				    <td>{{$order->id}}</td>
				    <td>{{$order->total}}</td>
				    <td>{{$order->store->title}}【{{$order->type->name}}】</td>
				    @if($order->user)
				    	 <td>{{$order->user->nick_name}}</td>
				    @else
				    	 <td></td>
				    @endif
				   
				    <td>{{$order->created_at}}</td>
				    <td>{{$order->new_status()->name}}</td>
				    <td><a href="{{route('orders.show',$order->id)}}">查看详情</a></td>
		       </tr>
		    @endforeach
		   
		</table>
		@if($search == 2)
			{{$orders->appends(['store_id'=>$store->id])->render()}}
		@endif
	</div>
@stop