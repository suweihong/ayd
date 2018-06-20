@extends('layouts.layout')

@section('title','商家管理-新增')

@section('content')

<div class="con_right storeadd" >
	@include('_messages')
	<h1 class="in_title">商家管理-新增</h1>
	<label class="title">基础信息</label>
	<form action="{{route('stores.store')}}" method="post" class="store_base_msg" name="form">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form_name">
			<span class="form_name_n">名称</span>
			<input type="text" class="form_name_ipt" name="title" placeholder="场馆名称" value="{{ old('title') }}">
		</div> 
		<div class="form_name">
			<span  class="form_name_n">商家位置 </span>
				<select class="form_name_s" name="province">
				    <option >吉林省</option>
				    <option>吉林省</option>
				</select>  
				<select class="form_name_s form_name_r" name="city">
				    <option>长春市</option>
				    <option>长春市</option>
				</select>  
				<select class="form_name_s form_name_r" name="area">
				    <option>净月区</option>
				    <option>净月区</option>
				</select>  
			<br>
			<input type="text" class="form_name_address" name="address" placeholder="如xx街道xx号" value="{{ old('address') }}" />
			<br>
			<input type="text" class="form_name_address" name='map' placeholder="地图名片地址" value="{{ old('map') }}" />
			<br>
		</div> 
		<div class="form_name">
			<span class="form_name_n">联系电话 </span>
			<input type="text" class="form_name_ipt" placeholder="" name="phone" value="{{ old('phone') }}" />
		</div>
		<div class="form_name">
			<div class="form_name_n form_name_p1">
				<span>场馆简介 </span>
			</div>
			<textarea rows="3" cols="20" class="form_name_txt" name="introduction" value="{{ old('introduction') }}"></textarea>
		</div>  
		<a href="javascript:document.form.submit();" class="form_name_submit" >新增</a>
		<a href="{{ route('stores.index') }}" class="form_name_back">返回</a>
	</form>
</div>
@stop