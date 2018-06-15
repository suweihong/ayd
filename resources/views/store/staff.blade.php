@extends('layouts.layout')

@section('title','商家管理')

@section('content')


	<!-- <h1>员工管理</h1> -->
	<div class="con_right storebase" >
		@include('store._first',['shadow'=>1,'store_id'=>$store->id])
		@include('store._second',['shadow'=>3,'store_id'=>$store->id])
		<div class="store_base_starf">
			<div class="starflist">
				<div class="starflist_item">
					<div class="masked">删除</div>
					<img src="img/uu.jpg">
					<p class="starf_name">张三</p>
				</div>
				<div class="starflist_item">
					<div class="masked">删除</div>
					<img src="img/uu.jpg">
					<p class="starf_name">张三</p>
				</div>
			</div>
			<div class="mask_codebox">
				<img src="img/erweima.jpg" alt="">
				<p>请使用微信扫描以上二维码完成绑定</p>
				<a href="javascript:;" class="form_name_close">关闭</a>
			</div>
			<a href="javascript:;" class="form_name_submitn form_name_newadd" type="submit">新增员工</a>
		</div>
	</div>
@stop