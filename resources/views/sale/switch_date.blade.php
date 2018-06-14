
@extends('layouts.layout')

@section('title','场地管理')

@section('content')
	<div class="con_right storesale">
		@include('store._first',['shadow'=>2,'store_id'=>$store->id])
		@include('store._third',['shadow'=>3,'store'=>$store,'sale'=>4,'type_id'=>$type_id])
		@include('store._fourth',['shadow'=>2,'switch'=>1,'now'=>$now,'type_id'=>$type_id,'date'=>1])
		<table class="table_btn">
			    <tr>
					<th class="none"></th>
					<?php foreach ($prices as $key => $price): ?>
						@if($key == $start_time)
							@foreach($price as $v)
								<th>场地{{$loop->iteration}}{{$v->place_id}}</th>
							@endforeach
						@endif
					<?php endforeach ?>
				</tr>
				<?php foreach ($prices as $key => $price): ?>
					<tr>
						<td>{{$key}}:00-{{$key+1}}:00</td>
						@foreach($price as $value)
							<td onclick="btnSwitchClick({{$value->id}})"><input type="text" id="{{$value->id}}" value="{{$value->price}}" maxlength="8" disabled="disabled" @if($value->switch == '')class="table_btn_num bsck_fff" @elseif($value->switch == 2) class="table_btn_num bsck_green"
							@else class="table_btn_num bsck_black"  @endif
							/></td>
						@endforeach
					</tr>
				<?php endforeach ?>
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
				<p>点击空闲场地-&gt;关闭</p>
				<p>点击关闭场地-&gt;打开</p>
				<p>点击已销售场地-&gt;查看订单</p>
			</div>
			<!-- <a href="javascript:;" class="updata_salenum">更新销售数据</a> -->

	</div>
	

		
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
