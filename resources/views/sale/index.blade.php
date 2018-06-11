@extends('layouts.layout')

@section('title','商家管理')

@section('content')

	<div class="con_right storesale">
		@include('_messages')
		@include('store._first',['shadow'=>2,'store_id'=>$store->id])
		@include('store._third',['shadow'=>1,'store'=>$store,'sale'=>0,'type_id'=>$type_id])
		<div class="storesale_place">
			@foreach($places as $place)
				<a href="javascript:;"><span class="masked">删除</span>场地{{$loop->iteration}}{{$place->id}}</a>
			@endforeach
			
			<form action="{{route('fields.store')}}" method="post" name="form">
				<input type="hidden" name="_token" value=" {{ csrf_token() }}" />
				<input type="hidden" name="store_id" value="{{$store->id}}"/>
				<input type="hidden" name="type_id" value="{{$type_id}}"/>
				<a href='javascript:document.form.submit();' class="storemenu2_add">新增</a>
			</form>
		</div>
		<div id="storeTime">
			营业时间:
			<input type="time" class="start_time" name="start_time" value="{{ old('start_time',$hours[0]) }}">
			至
			<input type="time" class="end_time" name="end_time"  value="{{ old('end_time',$hours[1]) }}">
		</div>
		<a href="javascript:;" class="updata_salenum">更新销售数据</a>
	</div>
@stop