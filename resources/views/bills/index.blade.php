@extends('layouts.layout')

@section('title','财务对账')

@section('content')
	
	<div class="con_right storeorder">
		@include('_messages')
		<h1 class="in_title">财务对账</h1>
		<form action="{{route('bills.index')}}" method="get" name="form">
			<input type="hidden" name="search" value="1">
			<div class="searchbox">
				<p>账单时间</p>
				<input type="text" readonly="readonly" class="demo-input ordernum laydate_1" value="{{$bill_date ?? $now}}" name="bill_date">
			</div>
			<div class="searchbox">
				<p>确认时间</p>
				<input type="text" readonly="readonly" class="demo-input ordernum laydate_3" value="{{$date ?? $now}}" name="date">
			</div>
			<div class="searchbox">
				<p>商家名称</p>
				<select class="ordernum" name="store_id">
					<option value="0">全部</option>
					@foreach($stores as $store)
					    <option value="{{$store->id}}" @if($store->id == $store_id ) selected="selected" @endif>{{$store->title}}</option>
					@endforeach	                           
				</select>
			</div>
			<div class="searchbox">
				<p>价格区间</p>
				<input type="text" class="orderprice" value="{{$balance_start ?? 0}}" name="balance_start">
				至
				<input type="text" class="orderprice" value="{{$balance_end ?? 99999}}" name="balance_end">
			</div>
			<a href="javascript:document.form.submit();" class="orderjian">检索</a>
			@if($search == 2)
				<a href="/export/bills" class="orderjian orderjian_r">导出当前数据</a>
			@else
				<a href="/export/bills?search=1&bill_date={{$bill_date}}&date={{$date}}&store_id={{$store_id}}&balance_start={{$balance_start}}&balance_end={{$balance_end}}" class="orderjian orderjian_r">导出当前数据</a>
			@endif
		</form>
		
		<table border="1" class="table_line">
		    <tr>
		      <th>序号</th>
		      <th>场馆</th>
		      <th>账单时间</th>
		      <th>订单金额</th>
		      <th>代收金额</th>
		      <th>结算金额</th>
		      <th>确认状态</th>
		      <th>确认时间</th>
		    </tr>
		    @foreach($bills as $key => $bill)
			    <tr>
				    <td>{{$key+1}}</td>
				    <td>{{$bill->store->title}}</td>
				    <td>{{$bill->time_start}} 至 {{$bill->time_end}}</td>
				    <td>{{$bill->total}}</td>
				    <td>{{$bill->collection}}</td>
				    <td>{{$bill->balance}}</td>
				    <td>{{$bill->check->name}}</td>
				    @if($bill->check_id == 7)
				    	<td>{{$bill->updated_at}}</td>
				    @else
				    	<td></td>
				    @endif
			    </tr>
			@endforeach
		</table>
		{{$bills->appends(['bill_date'=>$bill_date,'date'=>$date,'store_id'=>$store_id,'balance_start'=>$balance_start,'balance_end'=>$balance_end,'search'=>$search])->render()}}
	</div>

@stop