@extends('layouts.layout')

@section('title','商家管理-新增')

@section('content')
	<div class="row">
		
		@include('_messages')

		<div class="col-xs-12 in_box">
			<div class="alert" role="alert">
				<span class="in_title">商家管理 - 新增</span>
			</div>
			<label class="title">基础信息</label>
			<form action="{{route('stores.store')}}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="col-xs-12">
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="col-xs-1">名称 </span>
						<input type="text" class="form-control col-xs-6" name="title" placeholder="场馆名称" value="{{ old('title') }}" />
					</label> 
					<label class="form-inline col-xs-12 form-inline-g">
						<span  class="col-xs-1">商家位置 </span>
						<div class="form-group">
							<select class="form-control" name="province">
							    <option >吉林省</option>
							    <option>吉林省</option>
							</select>  
						</div>
						<div class="form-group">
							<select class="form-control" name="city">
							    <option>长春市</option>
							    <option>长春市</option>
							</select>  
						</div>
						<div class="form-group">
							<select class="form-control" name="area">
							    <option>净月区</option>
							    <option>净月区</option>
							</select>  
						</div>
						<br>
						<input type="text" class="form-control form-control_ipt" name="address" placeholder="如xx街道xx号" value="{{ old('address') }}" />
						<br>
						<input type="text" class="form-control form-control_ipt" name='map' placeholder="地图名片地址" value="{{ old('map') }}" />
						<br>
					</label> 
					<label class="form-inline col-xs-12 form-inline-g">
						<span>联系电话 </span>
						<input type="text" class="form-control" placeholder="" name="phone" value="{{ old('phone') }}" />
					</label>
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="form-inline-g-ap">场馆简介 </span>
						 <textarea rows="3" cols="20" class="form-control" name="introduction" value="{{ old('introduction') }}"></textarea>
					</label>  
					 <button class="btn btn-info col-xs-1" type="submit">新增</button>

					<a href="{{ route('stores.index') }}" class="btn clickt col-xs-1">返回</a>
				</div>
			</form>
		</div>
	</div>		
@stop