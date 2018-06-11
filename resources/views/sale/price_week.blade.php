
@extends('layouts.layout')

@section('title','场地管理')

@section('content')
<div class="con_right storesale">
	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>2,'store'=>$store,'sale'=>1,'type_id'=>$type_id])
	@include('store._fourth',['shadow'=>1,'store_id'=>$store->id,'switch'=>0,'now'=>$now,'type_id=$type_id'])
	<div class="storesale_data">
		<a @if($week == 1) class="active" @endif href="{{ route('fields.create') }}?week=1&&type_id={{$type_id}}">星期一</a>
		<a @if($week == 2) class="active" @endif href="{{route('fields.create')}}?week=2&&type_id={{$type_id}}" >星期二</a>
		<a @if($week == 3) class="active" @endif href="{{route('fields.create')}}?week=3&&type_id={{$type_id}}">星期三</a>
		<a @if($week == 4) class="active" @endif href="{{route('fields.create')}}?week=4&&type_id={{$type_id}}">星期四</a>
		<a @if($week == 5) class="active" @endif href="{{route('fields.create')}}?week=5&&type_id={{$type_id}}">星期五</a>
		<a @if($week == 6) class="active" @endif href="{{route('fields.create')}}?week=6&&type_id={{$type_id}}">星期六</a>
		<a @if($week == 7) class="active" @endif href="{{route('fields.create')}}?week=7&&type_id={{$type_id}}">星期日</a>
	</div>
	<table class="table_btn">
		<tr>
			<th class="none"></th>
			<?php foreach ($prices as $key => $price): ?>
				@if($key == $start_time)
					@foreach($price as $v)
							<th>场地{{$loop->iteration}}{{$v->place_id}}</th>
					@endforeach
				@endif
			<?php endforeach ?>
		</tr>
		<?php foreach ($prices as $key => $price): ?>
			<tr>
				<td>{{$key}}:00-{{$key+1}}:00</td>
				@foreach($price as $value)
				<td><input type="text" value="{{$value->price}}" maxlength="8" class="table_btn_num"/></td>
				@endforeach
			</tr>
		<?php endforeach ?>
	</table>
	<div class="btn btn-info" style="margin:20px 40px">更新销售数据</div>
</div>

@stop