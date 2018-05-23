@extends('layouts.layout')

@section('title','添加运动品类')

@section('content')
	<div class="row">
		<div class="col-xs-12 in_box">
			<div class="alert" role="alert">
				<span class="in_title">销售分类</span>
			</div>
			<div class="col-xs-12 type_con">
				<label class="type_title">分类名称</label>
				<form role="form"  class="col-xs-4">
				  <div class="form-group">
				    <select class="form-control">
				        <option>踢足球</option>
				        <option>游泳</option>
				        <option>慢跑</option>
				        <option>跳舞</option>
				    </select>  
				  </div>
				</form> 
			</div>
			<a href="{{ route('types.create')}}" class="btn btn-info type_add">　　新增　　</a>
		</div>
	</div>		
@stop