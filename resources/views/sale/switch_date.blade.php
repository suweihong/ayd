
@extends('layouts.layout')

@section('title','场地管理')

@section('content')
	
	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>3,'store'=>$store,'sale'=>4,'type_id'=>$type_id])
	@include('store._fourth',['shadow'=>2,'switch'=>1,'now'=>$now,'type_id'=>$type_id])

	<!-- <h1>场地价格</h1> -->
		
		<div class="tab-pane fade in active saletab" id="saletab1">
		<table class="col-sm-12">
			<tr>
				<th class="btn"></th>
				<th class="btn btn-info">场地一</th>
				<th class="btn btn-info">场地二</th>
				<th class="btn btn-info">场地三</th>
				<th class="btn btn-info">场地四</th>
				<th class="btn btn-info">场地五</th>
			</tr>
			<tr>
				<td class="btn btn-info">08-09</td>
				<td class="btn btn-btn">212</td>
				<td class="btn btn-btn click_green">212</td>
				<td class="btn btn-btn click_black">212</td>
				<td class="btn btn-btn">212</td>
				<td class="btn btn-btn">212</td>
			</tr>
			<tr>
				<td class="btn btn-info">09-10</td>
				<td class="btn btn-btn">212</td>
				<td class="btn btn-btn">212</td>
				<td class="btn btn-btn">212</td>
				<td class="btn btn-btn">212</td>
				<td class="btn btn-btn">212</td>
			</tr>
		</table>
		<div class="swichbox">
			<p class="swichi_p1"></p>
			<p class="swichi_p2"></p>
			<p class="swichi_p3"></p>
			<p class="swichi_p4">空闲</p>
			<p class="swichi_p5">已销售</p>
			<p class="swichi_p6">已关闭</p>
		</div>
		<div class="swichboxmsg">
			<h5>交互说明</h5>
			<p>点击空闲场地->关闭</p>
			<p>点击关闭场地->打开</p>
			<p>点击已销售场地->查看订单</p>
			
		</div>
		<div class="btn btn-info" style="margin:20px 40px">更新销售数据</div>
	</div>
		
@stop
