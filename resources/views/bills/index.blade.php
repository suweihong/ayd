@extends('layouts.layout')

@section('title','财务对账')

@section('content')
	
	<div class="con_right storeorder">
		<h1 class="in_title">财务对账</h1>
		<div class="searchbox">
			<p>账单时间</p>
			<input type="text" readonly="readonly" class="demo-input ordernum laydate_1">
		</div>
		<div class="searchbox">
			<p>确认时间</p>
			<input type="text" readonly="readonly" class="demo-input ordernum laydate_3">
		</div>
		<div class="searchbox">
			<p>商家名称</p>
			<input type="text" class="ordernum" placeholder="按名字检索">
		</div>
		<div class="searchbox">
			<p>价格区间</p>
			<input type="text" class="orderprice" value="0">
			至
			<input type="text" class="orderprice" value="99999">
		</div>
		<a href="javascript:;" class="orderjian">检索</a>
		<a href="/export/bills" class="orderjian orderjian_r">导出当前数据</a>
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
		    <tr>
		      <td>1</td>
		      <td>健身中心</td>
		      <td>2018-12-12 12:12</td>
		      <td>33</td>
		      <td>33</td>
		      <td>33</td>
		      <td>未核销</td>
		      <td>2018-12-12 12:12</td>
		    </tr>
		</table>
	</div>

@stop