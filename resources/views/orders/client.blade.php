@extends('layouts.layout')

@section('title','订单管理')

@section('content')
	<!-- <h1>按用户订单</h1> -->
	<div class="con_right storemanage"">
		<h1 class="in_title">订单查询 -- 按用户</h1>
	
		<form action="/client/orders" name="form">
			<div class="search">
				<input type="hidden" name="search" value="4">
				<select class="searchstyle" name="client_id">
					@foreach($clients as $clien)
						<option value="{{$clien->id}}">{{$clien->nick_name}}</option>
					@endforeach
				</select>
				<input type="text" readonly="readonly" class="demo-input searchstyle laydate_2" name="date" value="{{$now}}">
				<select class="searchstyle searchstyle_w" name="status_id">
					@foreach($status_list as $status)
					    <option value="{{$status->id}}">
					    	{{$status->name}}
					    </option>
					@endforeach	
				</select>
				<select class="searchstyle searchstyle_w" name="type_id">
					<option value="0">全部</option>
					@foreach($types as $type)
						<option value="{{$type->id}}">{{$type->name}}</option>
					@endforeach
				</select>
				<a href="javascript:document.form.submit();" class="search_jian">检索</a>
				@if($search == 5)
					<a href="/export/orders?client_id={{$client->id}}" class="search_add_out">导出当前数据</a>
				@elseif($search == 4)
					<a href="/export/orders?client_id={{$client->id}}&date={{$date}}&status_id={{$status_id}}&type_id={{$type_id}}&search=4" class="search_add_out">导出当前数据</a>
				@endif
			</div>
		</form>
		
		<p class="changguan">用户：{{$client->nick_name}}</p>
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
				    <td>{{$order->client->nick_name}}</td>
				    <td>{{$order->created_at}}</td>
				    <td>{{$order->new_status()->name}}</td>
				    <td><a href="{{route('orders.show',$order->id)}}">查看详情</a></td>
		       </tr>
		    @endforeach
		   
		</table>
		{{$orders->appends(['status_id'=>$status_id,'client_id'=>$client->id,'search'=>$search,'date'=>$date,'type_id'=>$type_id])->render()}}
	</div>
@stop