@extends('layouts.layout')

@section('title','商家管理')

@section('content')
	<div class="row">
		<div class="col-xs-12 in_box">
			<div class="alert" role="alert">
				<span class="in_title">商家管理</span>
			</div>
			<div class="col-xs-12">
				<input type="text" class="col-xs-3 btn" placeholder="按名称检索">
				<div class="form-group col-xs-3">
					<select class="form-control">
					    <option>签约商家</option>
					    <option>锁定商家</option>
					</select>  
				</div>
				<a href="{{route('stores.index')}}" class="btn btn-info col-xs-1">检索</a>
				<a href="{{route('stores.create')}}" class="btn clickt col-xs-1">新增</a>
				<a href="{{route('stores.edit',1)}}" class="btn clickt col-xs-1">管理商家</a>
			</div>
		</div>
	</div>		
@stop