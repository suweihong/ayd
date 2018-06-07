
@extends('layouts.layout')
@section('content')
	@include('_messages')
	<div class="alert" role="alert">
		<span class="in_title">销售分类</span>
	</div>
	<form action="{{route('items.store')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
		<input type="hidden" name="store_id" value="{{$store_id}}">
		<div class="form-group formr-group">
		 	<label for="male" class="col-sm-2">销售类别</label>
			<select class="formr-control" id="male" name="item_id">
			    <option selected="selected" value="1">场地</option>
			</select>  
		</div>
		<div class="form-group formr-group">
		 	<label for="male" class="col-sm-2">体育类型</label>
			<select class="formr-control" id="male" name="type_id">
			   	@foreach($types as $type) 
					    <option value="{{$type->id}}">{{$type->name}}</option>
				@endforeach
			</select>  
		</div>
		<div class="form-group formr-group">
		 	<label for="male" class="col-sm-2">限购规则</label>
			<select class="formr-control" id="male" name="rule">
			    <option>不限购</option>
			</select>  
		</div>
			<button class="btn btn-info updatanum" style="margin-left: 86px">　新增　</button>
	</form>
	<form action="{{route('items.store')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
		<input type="hidden" name="store_id" value="{{$store_id}}">
		<div class="form-group formr-group">
		 	<label for="male" class="col-sm-2">销售类型</label>
			<select class="formr-control" id="male" name="item_id">
			    <option selected="selected" value="2">票卡</option>
			</select>  
		</div>
		<div class="form-group formr-group">
		 	<label for="male" class="col-sm-2">体育类型</label>
			<select class="formr-control" id="male" name="type_id">
				@foreach($types as $type)
					    <option value="{{$type->id}}">{{$type->name}}</option>
				@endforeach
			</select>  
		</div>
		<div class="form-group formr-group">
		 	<label for="male" class="col-sm-2">名称</label>
			<input type="text" value="篮球午后场" name="name">
		</div>
		<div class="form-group formr-group">
		 	<label for="male" class="col-sm-2">限购规则</label>
			<select class="formr-control" id="male" name="rule">
			    <option value="1">不限购</option>
			    <option value="2">24小时买一次</option>
			</select>  
		</div>
		<button class="btn btn-info updatanum" style="margin-left: 86px">　新增　</button>
	</form>

	<!-- <div class="form-group formr-group">
	 	<label for="male" class="col-sm-2">销售类型</label>
		<select class="formr-control" id="male">
		    <option>票卡</option>
		    <option>场地</option>
		</select>  
	</div>
	<div class="form-group formr-group">
	 	<label for="male" class="col-sm-2">体育类型</label>
		<select class="formr-control" id="male">
		    <option>篮球</option>
		    <option>足球</option>
		    <option>兵乓球</option>
		</select>  
	</div>
	<div class="form-group formr-group">
	 	<label for="male" class="col-sm-2">名称</label>
		<input type="text" value="篮球午后场">
	</div>
	<div class="form-group formr-group">
	 	<label for="male" class="col-sm-2">限购规则</label>
		<select class="formr-control" id="male">
		    <option>不限购</option>
		</select>  
	</div>
	<div class="btn btn-info updatanum" style="margin-left: 86px">　新增　</div> -->

@stop