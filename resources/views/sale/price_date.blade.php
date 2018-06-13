
@extends('layouts.layout')

@section('title','场地管理')

@section('content')
	
	<div class="con_right storesale">
	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>2,'store'=>$store,'sale'=>1,'type_id'=>$type_id])
	@include('store._fourth',['shadow'=>1,'store_id'=>$store->id,'switch'=>0,'now'=>$now,'type_id=$type_id'])
	
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
				<td>
					<input type="text" onchange="datePrice({{$value->id}})" id="{{$value->id}}" value="{{$value->price}}" maxlength="8" class="table_btn_num"/>
				</td>
				@endforeach
			</tr>
		<?php endforeach ?>
	</table>
	<a href="javascript:;" class="updata_salenum" onclick="price()">更新销售数据</a>
</div>
	
	<script type="text/javascript">
	arr=[]
	function datePrice(id){
		arr.push({'id':id,'price':$('#'+id).val()})
	}
	function price(){
		$.ajax({
			url : '/price/update',
			type : 'POST',
			data : {
				'_token' : '{{csrf_token()}}',
				'arr' : arr,
				'date' : 1,
			},
			success : function(data)
			{
				console.log(data)
			}
		})
		arr=[]
	}
</script>
	
@stop