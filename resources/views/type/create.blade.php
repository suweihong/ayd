@extends('layouts.layout')

@section('title','添加运动品类')

@section('content')
	<div class="row">
		@include('_messages')
		<div class="col-xs-12 in_box">
			<div class="alert" role="alert">
				<span class="in_title">销售分类</span>
			</div>
			<div class="col-xs-12 type_con">
				<label class="type_title">分类名称</label>
				<form role="form"  class="col-xs-4" method="post" action="{{route('types.store')}}">
					<input type="hidden" name="_token" value="{{ csrf_token()}}">
					  <div class="form-group">
					  	<input type="text" name="type" value="" class="form-control">  
					    {{-- <select class="form-control">
					        <option>踢足球</option>
					        <option>游泳</option>
					        <option>慢跑</option>
					        <option>篮球</option>
					        <option>羽毛球</option>
					        <option>乒乓球</option>
					        <option>跳舞</option>
					        <option>跳舞</option>
					    </select>   --}}
					  </div>
					 
					  <button type="submit" class="btn btn-info type_add" style="margin-left: -1px;">　　新增　　</button>
				</form> 
			</div>
			
		</div>
	</div>		
@stop