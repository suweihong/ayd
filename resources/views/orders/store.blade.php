@extends('layouts.layout')

@section('title','订单管理')

@section('content')
	<!-- <h1>按商家订单</h1> -->
	<div class="con_right storemanage">
<<<<<<< HEAD
		<h1 class="in_title">订单查询</h1>
		<div class="search">
			<input class="searchstyle" type="text" placeholder="订单号">
			<input type="text" readonly="readonly" class="demo-input searchstyle laydate_2">
			<select class="searchstyle searchstyle_w">
				<option value="">羽毛球</option>
				<option value="">足球</option>
			</select>
			<a href="javascript:;" class="search_jian">检索</a>
			<a href="javascript:;" class="search_add_out">导出当前数据</a>
		</div>
		<p class="changguan">场馆：奇乐健身中心</p>
=======
		<!--<h1 class="in_title">订单查询</h1>-->
		@include('_messages')
		@include('store._first',['shadow'=>3,'store_id'=>$store->id])
		<form action="/store/orders" method="get" name="form">
			<div class="search">
				<input type="hidden"  name="search" value="1">
				<input type="hidden" name="store_id" value="{{$store->id}}">
				<input class="searchstyle" type="text" placeholder="订单号" name="order_id" value="{{ old('order_id') }}">
				<input class="searchstyle" type="text" placeholder="8月12日-9月12日">
				<select class="searchstyle searchstyle_w" name="type_id">
					<option value="0">全部</option>
						@foreach($store_types as $type)
						    <option value="{{$type->id}}">{{$type->name}}</option>
						@endforeach	
				</select>
				<a href="javascript:document.form.submit();" class="search_jian">检索</a>
				<a href="/export/orders" class="search_add_out">导出当前数据</a>
		    </div>                                                       
		</form>

		
		<p class="changguan">场馆：{{$store->title}}</p>
>>>>>>> cbbdbca79150572d0799f36974a7324eef72961c
		<table border="1" class="table_line">
		    <tr>
		      <th>序号</th>
		      <th>订单号</th>
		      <th>销售价格</th>
		      <th>场馆</th>
		      <th>购买信息</th>
		      <th>购买时间</th>
		    </tr>
		    @foreach($orders as $k => $order)
		        <tr>
		        	<td>{{$k+1}}</td>
				    <td>{{$order->id}}</td>
				    <td>{{$order->total}}</td>
				    <td>{{$order->store->title}}【{{$order->type->name}}】</td>
				    <td>{{$order->client->nick_name}}</td>
				    <td>{{$order->created_at}}</td>
				   
		       </tr>
		    @endforeach
		   
		</table>
	</div>
@stop