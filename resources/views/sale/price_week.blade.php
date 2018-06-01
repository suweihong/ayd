@extends('layouts.layout')

@section('title','场地管理')

@section('content')
	
	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>2,'store'=>$store,'sale'=>1,'type_id'=>$type_id])
	@include('store._fourth',['shadow'=>1,'store_id'=>$store->id,'switch'=>0])

	
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
			<div class="btn btn-info" style="margin:20px 40px">更新销售数据</div>
		</div>
		
@stop