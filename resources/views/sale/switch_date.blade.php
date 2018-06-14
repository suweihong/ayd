
@extends('layouts.layout')

@section('title','场地管理')

@section('content')
	<div class="con_right storesale">
		@include('store._first',['shadow'=>2,'store_id'=>$store->id])
		@include('store._third',['shadow'=>3,'store'=>$store,'sale'=>4,'type_id'=>$type_id])
		@include('store._fourth',['shadow'=>2,'switch'=>1,'now'=>$now,'type_id'=>$type_id,'date'=>1])
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
							<td onclick="dateSwitchClick({{$value->id}})"><input type="text" id="{{$value->id}}" value="{{$value->price}}" maxlength="8" disabled="disabled" @if($value->switch == '')class="table_btn_num bsck_fff" @elseif($value->switch == 2) class="table_btn_num bsck_green"
							@else class="table_btn_num bsck_black"  @endif
							/></td>
						@endforeach
					</tr>
				<?php endforeach ?>
			</table>
			<div class="swichbox">
				<p class="swichi_p1"></p>
				<p class="swichi_p2"></p>
				<p class="swichi_p3"></p>
				<p class="swichi_p4">空闲</p>
				<p class="swichi_p5">已销售</p>
				<p class="swichi_p6">已关闭</p>
			</div>
			<div class="swichboxmsg">
				<h5>交互说明</h5>
				<p>点击空闲场地-&gt;关闭</p>
				<p>点击关闭场地-&gt;打开</p>
				<p>点击已销售场地-&gt;查看订单</p>
			</div>
			<!-- <a href="javascript:;" class="updata_salenum">更新销售数据</a> -->

	</div>
	<script type="text/javascript">
		if(sessionStorage.getItem("data")!=null){
		$('#test2').val(sessionStorage.getItem("data"))
	}

		//修改场地状态
		function dateSwitchClick(id){
			$.ajax({
				url: '/fields/'+id+'/edit',
				type: 'GET',
				success : function(data){
					if(data == ''){
						$('#'+id).removeClass('bsck_black').addClass('bsck_fff')
					}else if(data == 1){
						$('#'+id).addClass('bsck_black').removeClass('bsck_fff')
					}else{
						location.href = "{{route('orders.show',1)}}";
					}
				}
			})
		}
	</script>

		
@stop
