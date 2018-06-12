@extends('layouts.layout')

@section('title','场地管理')

@section('content')

<div class="con_right storecard">

	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>4,'store'=>$store,'sale'=>5,'type_id'=>$type_id])

	<div class="storecard_itembox">
		@foreach($tickets as $ticket)
			<div class="storecard_item">
			<p class="storecatd_p1">票卡名称：{{$ticket->name}}</p>
			<p class="storecatd_p2">票卡备注说明：{{$ticket->intro}}</p>
			<p class="storecatd_p3">价格：{{$ticket->price}}</p>

				<a  @if($ticket->switch == '')class="storecatd_p4" @else class="storecatd_p5"@endif href="javascript:;"> @if($ticket->switch == '') 销售中 @else 暂停销售 @endif</a>

			<a class="storecatd_p5" href="javascript:;">删除</a>
		</div>
		@endforeach
		
	</div>
	<a href="{{route('items.create')}}?store_id={{$store->id}}" class="updata_salenum">新增</a>
</div>
@stop