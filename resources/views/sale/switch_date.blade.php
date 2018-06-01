@extends('layouts.layout')

@section('title','场地管理')

@section('content')
	
	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>3,'store'=>$store,'sale'=>4,'type_id'=>$type_id])
	@include('store._fourth',['shadow'=>2,'switch'=>1])

	<!-- <h1>场地价格</h1> -->
		
		<div class="tab-pane fade in active saletab" id="saletab1">
			按日期按日期 开关
			<div class="btn btn-info" style="margin:20px 40px">更新销售数据</div>
		</div>
		<div class="tab-pane fade saletab" id="saletab2">
			爱上这个法师的公司的
		</div>
@stop