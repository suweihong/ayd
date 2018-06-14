@extends('layouts.layout')

@section('title','场地管理')

@section('content')
	
	<div class="con_right storeorder">
		<h1 class="in_title">财务对账</h1>
		<div class="searchbox">
			<p>账单时间</p>
			<input type="text" class="ordernum" value="8月4日">
		</div>
		<div class="searchbox">
			<p>确认时间</p>
			<input type="text" class="ordernum" value="8月4日">
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
		<a href="javascript:;" class="orderjian orderjian_r">导出当前数据</a>
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
		    <tr>
		      <td>1</td>
		      <td>1152312</td>
		      <td>88</td>
		      <th>健身中心</th>
		      <th>张三</th>
		      <td>2018-12-12 12:12</td>
		      <th>未核销</th>
		    </tr>
		</table>
	</div>

@stop