@extends('store._fourth')

@section('title','场地管理')

@section('part')
	<!-- <h1>开关按星期</h1> -->
		
	<div class="tab-pane fade in active saletab" id="saletab1">
		<ul class="nav nav-pills">
			<li class="active btn btnt btnt0" data-toggle="tab"><a>星期一</a></li>
			<li class="btn btnt" data-toggle="tab"><a>星期二</a></li>
			<li class="btn btnt" data-toggle="tab"><a>星期三</a></li>
			<li class="btn btnt" data-toggle="tab"><a>星期四</a></li>
			<li class="btn btnt" data-toggle="tab"><a>星期五</a></li>
			<li class="btn btnt" data-toggle="tab"><a>星期六</a></li>
			<li class="btn btnt" data-toggle="tab"><a>星期日</a></li>
		</ul>
		<table class="col-sm-12" style="overflow: hidden;">
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
				<td class="btn btn-btn">212</td>
				<td class="btn btn-btn">212</td>
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