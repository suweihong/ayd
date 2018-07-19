@extends('layouts.layout')

@section('title','订单管理')

@section('content')

	<div class="con_right storemanage"">
		@include('_messages')
		<h1 class="in_title">订单查询 -- 按商家</h1>

		<form action="/shop/orders" name="form">
			<div class="search">
				<input type="hidden" name="search" value="2">	
				<select class="searchstyle" name="store_id">
					@foreach($stores as $st)
						<option value="{{$st->id}}" @if($st->id == $store_id) selected="selected" @endif>{{$st->title}}</option>
					@endforeach
				</select>
				
				<input type="text" readonly="readonly" class="demo-input searchstyle2 laydate_2" name="date" value="{{$date ?? $now}}">
				<select class="searchstyle searchstyle_w" name="status_id">
					@foreach($status_list as $status)
					    <option value="{{$status->id}}" @if($status->id == $status_id) selected="selected" @endif>
					    	{{$status->name}}
					    </option>
					@endforeach	
				</select>
				<select class="searchstyle searchstyle_w" name="type_id">
					<option value="0">全部</option>
					@foreach($types as $type)
						<option value="{{$type->id}}" @if($type->id == $type_id) selected="selected" @endif>{{$type->name}}</option>
					@endforeach
				</select>
				<a href="javascript:document.form.submit();" class="search_jian">检索</a>
				@if($search == 3)
					<a href="/export/orders?store_id={{$store->id}}" class="search_add_out">导出当前数据</a>
				@elseif($search == 2)
					<a href="/export/orders?store_id={{$store->id}}&date={{$date}}&status_id={{$status_id}}&type_id={{$type_id}}&search=2" class="search_add_out">导出当前数据</a>
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
		    @foreach($orders as $key => $order)
			    <tr>
			        <td>{{$key+1}}</td>
			        <td>{{$order->id}}</td>
			        <td>{{$order->total}}</td>
			        <td>{{$order->store->title}}【{{$order->type->name}}】</td>
			        @if($order->client)
			        	<td>{{$order->client->nick_name}}</td>
			        @else
			        	<td></td>
			        @endif
			        
			        <td>{{$order->created_at}}</td>
			        <td>{{$order->new_status()->name}}</td>
			        <td><a href="{{route('orders.show',$order->id)}}">查看详情</a></td>
			    </tr>
			@endforeach
		</table>
		{{$orders->appends(['status_id'=>$status_id,'store_id'=>$store->id,'search'=>$search,'date'=>$date,'type_id'=>$type_id])->render()}}
	</div>
@stop