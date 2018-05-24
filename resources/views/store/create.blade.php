@extends('layouts.layout')

@section('title','商家管理-新增')

@section('content')
	<div class="row">
		<div class="col-xs-12 in_box">
			<div class="alert" role="alert">
				<span class="in_title">商家管理 - 新增</span>
			</div>
			<label class="title">基础信息</label>
			<div class="col-xs-12">
				<label class="form-inline col-xs-12 form-inline-g">
					<span class="col-xs-1">名称 </span>
					<input type="text" class="form-control col-xs-6" placeholder="按名称检索"/>
				</label> 
				<label class="form-inline col-xs-12 form-inline-g">
					<span  class="col-xs-1">商家位置 </span>
					<div class="form-group">
						<select class="form-control">
						    <option>吉林省</option>
						    <option>吉林省</option>
						</select>  
					</div>
					<div class="form-group">
						<select class="form-control">
						    <option>长春市</option>
						    <option>长春市</option>
						</select>  
					</div>
					<div class="form-group">
						<select class="form-control">
						    <option>净月区</option>
						    <option>净月区</option>
						</select>  
					</div>
					<br>
					<input type="text" class="form-control form-control_ipt" placeholder="如xx街道xx号"/>
					<br>
					<input type="text" class="form-control form-control_ipt" placeholder="地图名片地址"/>
					<br>
				</label> 
				<label class="form-inline col-xs-12 form-inline-g">
					<span>联系电话 </span>
					<input type="text" class="form-control" placeholder="按名称检索"/>
				</label>
				<label class="form-inline col-xs-12 form-inline-g">
					<span class="form-inline-g-ap">场馆简介 </span>
					 <textarea rows="3" cols="20" class="form-control" placeholder="场馆简介"> </textarea>
				</label>  
				<a href="{{ route('stores.index')}}" class="btn btn-info col-xs-1">新增</a>
				<a href="{{ route('stores.index')}}" class="btn clickt col-xs-1">返回</a>
			</div>
		</div>
	</div>		
@stop