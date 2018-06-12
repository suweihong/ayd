
@extends('layouts.layout')
@section('content')
	
	<div class="con_right storecard">
		@include('_messages')
		<h1 class="in_title">销售分类</h1>
		<form action="{{route('items.store')}}" method="post" name="form">
			<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
			<input type="hidden" name="store_id" value="{{$store_id}}">
			<div class="form-group">
			 	<label>销售类别</label>
				<select class="formr-control" onchange="salestyle(this.options[this.options.selectedIndex].value)" id="salestyle_select" name="item_id">
				    <option selected="selected" value="1">场地</option>
				    <option selected="selected" value="2">票卡</option>
				</select>
			</div>
			<div class="form-group">
			 	<label>体育类型</label>
				<select class="formr-control" name="type_id">
				   	@foreach($types as $type)
						<option value="{{$type->id}}">{{$type->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group" id="salestyle_name">
			 	<label>名称</label>
				<input type="text" class="selectipt" value="{{old('name')}}" name="name" >
			</div>
			<div class="form-group" id="salestyle_price">
			 	<label>价格</label>
				<input type="text" class="selectipt" value="{{ old('price') }}" name="price">
			</div>
			<div class="form-group" id="salestyle_intro">
			 	<label>说明</label>
				<input type="text" class="selectipt" value="{{ old('intro')}}" name="intro">
			</div>
			<div class="form-group">
			 	<label>限购规则</label>
				<select class="formr-control" name="rule">
				    <option value="1">不限购</option>
				</select>
			</div>
			<a href="javascript:document.form.submit();" class="addsubmit">新增</a>
		</form>
	</div>
@stop