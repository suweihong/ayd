
@extends('layouts.layout')

@section('title','商家管理')

@section('content')

	<div class="con_right storebase">
		@include('_messages')

		@include('store._first',['shadow'=>1,'store_id'=>$store->id ])
		@include('store._second',['shadow'=>1,'store_id'=>$store->id ])
		<form action="{{route('stores.update',$store->id)}}" method="post" class="store_base_msg" name='form'>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PATCH">
			<div class="form_name">
				<span class="form_name_n">名称</span>
				<input type="text" class="form_name_ipt" name="title" placeholder="奥方体育馆" value="{{ old('title') }}">
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
			</div> 
			<div class="form_name">
				<div class="form_name_n form_name_p1">
					<span class="chang1">场馆封面图</span>
				</div>
				<div class="form_name_img" >
					<img src="/img/pic.jpg" width="100%" name="logo" >	
				</div>
			</div> 
			<div class="form_name">
				<div class="form_name_n form_name_p1">
					<span class="chang2">场馆实拍</span>
				</div>
				<div class="form_name_img">
					<img src="/img/pic.jpg" width="100%" name="imgs">	
				</div>
				<div class="form_name_img">
					<img src="/img/pic.jpg" width="100%" name="imgs">	
				</div>
				<div class="form_name_img">
					<img src="/img/pic.jpg" width="100%" name="imgs">	
				</div>
			</div> 
			<div class="form_name">
				<span class="form_name_n">联系电话 </span>
				<input type="text" class="form_name_ipt" placeholder="" name="phone" value="{{ old('phone') }}" />
			</div>
			<div class="form_name">
				<div class="form_name_n form_name_p1">
					<span class="changlast">场馆简介</span>
				</div>
				<textarea rows="3" cols="20" class="form_name_txt" name="introduction" value="{{ old('introduction') }}"></textarea>
			</div>  
			<a href="javascript:document.form.submit();" class="form_name_submit">更新场地信息</a>
			<a href="{{ route('stores.index') }}" class="form_name_back">返回</a>
		</form>
	</div>
@stop