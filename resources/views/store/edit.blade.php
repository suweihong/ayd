
@extends('layouts.layout')

@section('title','商家管理')

@section('content')
	<!-- <h1>基础信息管理页</h1> -->

	<div class="row">
		@include('_messages')

		@include('store._first',['shadow'=>1,'store_id'=>$store->id ])
		@include('store._second',['shadow'=>1,'store_id'=>$store->id ])

	
		<form action="{{route('stores.update',$store->id)}}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PATCH">
			<div class="col-xs-12 in_box">
				<div class="col-xs-12">
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="col-xs-1">名称 </span>
						<input type="text" class="form-control col-xs-6" name='title' placeholder="" value="{{ old('title',$store->title) }}" />
					</label> 
					<label class="form-inline col-xs-12 form-inline-g">
						<span  class="col-xs-1">商家位置 </span>
						<div class="form-group">
							<select class="form-control" name="province">
							    {{-- <option value="1">吉林省 @if (old('province',$store->province == 1)) selected @endif</option> --}}
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
						<input type="text" class="form-control form-control_ipt" name='address' placeholder="" value="{{ old('address',$store->address) }}" />
						<br>
						<input type="text" class="form-control form-control_ipt" name="map" placeholder="" value="{{ old('map',$store->map_url) }}" />
						<br>
					</label> 


					<label class="form-inline col-xs-12 form-inline-g">
						<span class="col-xs-1">场馆封面图 </span>
						<div class="pic_pic col-xs-3" >
							<img src="../../img/pic.jpg" width="100%" name="logo" >	
						</div>
					</label> 
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="col-xs-1">场馆实拍 </span>
					{{-- 	@if($store->imgs != null)
							
							@foreach($store->imgs as $img)
								<div class="pic_pic col-xs-3" >
									<img src="{{$img->img}}" width="100%" name="imgs">	
								</div>
							@endforeach
						@else --}}
				
							<div class="pic_pic col-xs-3" >
								<img src="../../img/pic.jpg" width="100%" name="imgs">	
							</div>
							<div class="pic_pic col-xs-3" >
								<img src="../../img/pic.jpg" width="100%" name="imgs">	
							</div>
						{{-- @endif --}}
					</label> 
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="col-xs-1">联系电话 </span>
						<input type="text" class="form-control" name="phone" placeholder="" value="{{ old('phone',$store->phone) }}" />
					</label>
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="form-inline-g-ap col-xs-1">场馆简介 </span>
						 <textarea rows="3" cols="20" class="form-control" placeholder="场馆简介" name="introduction" value= '{{ old("intruduction") }}'>{{$store->introduction}}</textarea>
					</label>  
					<button class="btn btn-info" type="submit">更新场地信息</button>
					<a href="{{ route('stores.index')}}" class="btn clickt">返回</a>

				</div>
			</div>
		</form>
		
	</div>			
@stop
	