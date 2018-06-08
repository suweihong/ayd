
@extends('layouts.layout')

@section('title','场地管理')

@section('content')
	
	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>2,'store'=>$store,'sale'=>1,'type_id'=>$type_id])
	@include('store._fourth',['shadow'=>1,'store_id'=>$store->id,'switch'=>0,'now'=>$now,'type_id=$type_id'])

<div class="tab-pane fade in active saletab" id="saletab1">

			<ul class="nav nav-pills">
				<li @if($week == 1) class="active btn btnt btnt0" @else class=" btn btnt btnt0" @endif ><a href="{{ route('fields.create') }}?week=1&&type_id={{$type_id}}">星期一</a></li>
				<li @if($week == 2) class="active btn btnt btnt0" @else class=" btn btnt" @endif><a href="{{route('fields.create')}}?week=2&&type_id={{$type_id}}" >星期二</a></li>
				<li @if($week == 3) class="active btn btnt btnt0" @else class=" btn btnt" @endif><a href="{{route('fields.create')}}?week=3&&type_id={{$type_id}}">星期三</a></li>
				<li @if($week == 4) class="active btn btnt btnt0" @else class=" btn btnt" @endif><a href="{{route('fields.create')}}?week=4&&type_id={{$type_id}}">星期四</a></li>
				<li @if($week == 5) class="active btn btnt btnt0" @else class=" btn btnt" @endif><a href="{{route('fields.create')}}?week=5&&type_id={{$type_id}}">星期五</a></li>
				<li @if($week == 6) class="active btn btnt btnt0" @else class=" btn btnt" @endif><a href="{{route('fields.create')}}?week=6&&type_id={{$type_id}}">星期六</a></li>
				<li @if($week == 7) class="active btn btnt btnt0" @else class=" btn btnt" @endif><a href="{{route('fields.create')}}?week=7&&type_id={{$type_id}}">星期日</a></li>
			</ul>

			<table class="col-sm-12">
				<tr>
					<th class="btn"></th>
					<!-- @foreach($places as $place)
						<th class="btn btn-info">场地{{$loop->iteration}}{{$place->id}}</th>
					@endforeach -->

				<?php foreach ($prices as $key => $price): ?>
					@if($key == 2)
						@foreach($price as $v)
								<th class="btn btn-info">场地{{$loop->iteration}}{{$v['place_id']}}</th>
						@endforeach
					@endif
				<?php endforeach ?>
				</tr>


				<?php foreach ($prices as $key => $price): ?>
					<tr>
						<td class="btn btn-info">{{$key}}:00-{{$key+1}}:00</td>
						@foreach($price as $value)

							<td class="btn btn-btn">{{$value['price']}}</input></td>


						@endforeach

					</tr>
				<?php endforeach ?>

			</table>
			<div class="btn btn-info" style="margin:20px 40px">更新销售数据</div>
		</div>
	
@stop