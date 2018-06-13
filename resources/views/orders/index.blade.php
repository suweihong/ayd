
@extends('layouts.layout')

@section('title','订单管理')

@section('content')
	<!-- <h1>所有订单</h1> -->
	<div class="con_right storeorder">
		<h1 class="in_title">订单查询</h1>
		<div class="searchbox">
			<p>订单号</p>
			<input type="text" class="ordernum" value="123123123">
		</div>
		<div class="searchbox">
			<p>日期区间</p>
			<input type="text" class="ordernum" value="8月12日-9月12日">
			<select class="orderstyle">
				<option value="1">下单</option>
				<option value="2">核销</option>
			</select>
		</div>
		<div class="searchbox">
			<p>运动品类</p>
			<select class="orderstyle">
				<option value="1">羽毛球</option>
				<option value="2">足球</option>
				<option value="3">健身</option>
			</select>
			<p class="fukuan1">付款类型</p>
			<select class="orderstyle fukuan2">
				<option value="1">全部</option>
				<option value="2">线上预定</option>
				<option value="3">系统代收</option>
				<option value="4">线下付款</option>
			</select>
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