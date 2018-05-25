
@extends('store._second')
	@section('main')
	<!-- <h1>基础信息管理页</h1> -->

	<div class="row">
		<form action="{{route('stores.update',$store->id)}}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PATCH">
			<div class="col-xs-12 in_box">
				<div class="col-xs-12">
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="col-xs-1">名称 </span>
						<input type="text" class="form-control col-xs-6" name='title' placeholder="{{$store->title}}"/>
					</label> 
					<label class="form-inline col-xs-12 form-inline-g">
						<span  class="col-xs-1">商家位置 </span>
						<div class="form-group">
							<select class="form-control" name="province">
							    <option>吉林省</option>
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
						<input type="text" class="form-control form-control_ipt" name='address' placeholder="{{$store->address}}"/>
						<br>
						<input type="text" class="form-control form-control_ipt" name="map" placeholder="{{$store->map_url}}"/>
						<br>
					</label> 

					<label class="form-inline col-xs-12 form-inline-g">
						<span class="col-xs-1">场馆封面图 </span>
						<div class="pic_pic col-xs-3" >
							<img src="{{$store->logo}}" width="100%" name="logo">	
						</div>
					</label> 
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="col-xs-1">场馆实拍 </span>
						@foreach($store->imgs as $img)
							<div class="pic_pic col-xs-3" >
							<img src="{{$img->img}}" width="100%" name="imgs">	
						</div>
						@endforeach
						
						{{-- <div class="pic_pic col-xs-3" >
							<img src="../../img/pic.jpg" width="100%">	
						</div>
						<div class="pic_pic col-xs-3" >
							<img src="../../img/pic.jpg" width="100%">	
						</div> --}}
					</label> 
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="col-xs-1">联系电话 </span>
						<input type="text" class="form-control" name="phone" placeholder="{{$store->phone}}"/>
					</label>
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="form-inline-g-ap col-xs-1">场馆简介 </span>
						 <textarea rows="3" cols="20" class="form-control" placeholder="场馆简介" name="introduction">{{$store->introduction}}</textarea>
					</label>  
					<button class="btn btn-info" type="submit">更新场地信息</button>
					<a href="{{ route('stores.index')}}" class="btn clickt">返回</a>
				</div>
			</div>
		</form>
		
	</div>			
@stop
	