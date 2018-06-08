
@extends('layouts.layout')

@section('title','场地管理')

@section('content')
	
	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>2,'store'=>$store,'sale'=>2,'type_id'=>$type_id])
	@include('store._fourth',['shadow'=>2,'store_id'=>$store->id,'switch'=>0,'now'=>$now,'type_id'=>$type_id])

	<!-- <h1>场地价格</h1> -->
		
		<div class="tab-pane fade in active saletab" id="saletab1">
		<table class="col-sm-12">
			<tr>
				<th class="btn"></th>
				@foreach($places as $place)
					<th class="btn btn-info">场地{{$loop->iteration}}{{$place->id}}</th>
				@endforeach	
			</tr>
			<?php foreach ($prices as $key => $price): ?>
					<tr>
						<td class="btn btn-info">{{$key}}:00-{{$key+1}}:00</td>
						@foreach($price as $value)

							<td class="btn btn-btn">{{$value['price']}}</td>

						@endforeach

					</tr>
				<?php endforeach ?>
			
		</table>
		<div class="btn btn-info" style="margin:20px 40px">更新销售数据</div>
	</div>
@stop