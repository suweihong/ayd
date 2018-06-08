@extends('layouts.layout')

@section('title','商家管理')

@section('content')
	<!-- <h1>销售</h1> -->
	@include('_messages')
	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>1,'store'=>$store,'sale'=>0,'type_id'=>$type_id])

	<ul class="col-sm-12" id="salePlace">
		@foreach($places as $place)
			<li class="btn btn-info">场地{{$loop->iteration}}{{$place->id}}</li>
		@endforeach
		<form action="{{route('fields.store')}}" method="post" name="form">
			<input type="hidden" name="_token" value=" {{ csrf_token() }}" />
			<input type="hidden" name="store_id" value="{{$store->id}}"/>
			<input type="hidden" name="type_id" value="{{$type_id}}"/>
			<li class="btn btn_btn"><a href='javascript:document.form.submit();'>新增<a/></li>
		</form>
		
	</ul>
	<form method="get" action="{{route('items.index')}}">
		<input type="hidden" name="store_id" value={{$store->id}}>
		<input type="hidden" name="type_id" value={{$type_id}}>
		<div class="row" id="storeTime">
			<div class="col-xs-12">
				<label>
					<span>营业时间:　</span>
				</label>
					<input type="time" name="start_time" value="{{ old('start_time',$hours[0]) }}">
				<label>至</label>
					<input type="time" name="end_time"  value="{{ old('end_time',$hours[1]) }}"/>	
			</div>
		</div>
		<button class="btn btn-info updatanum" type="submit">更新销售数据</button>
	</form>
	
@stop