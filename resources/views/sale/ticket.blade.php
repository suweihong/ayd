@extends('layouts.layout')

@section('title','场地管理')

@section('content')

<div class="con_right storecard">

	@include('_messages')
	@include('_delete')

	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>4,'store'=>$store,'sale'=>5,'type_id'=>$type_id])

	<div class="storecard_itembox">
		@foreach($tickets as $ticket)
			<div class="storecard_item" id="ticket{{$ticket->id}}">
				<p class="storecatd_p1">票卡名称：{{$ticket->name}}</p>
				<p class="storecatd_p2">票卡备注说明：{{$ticket->intro}}</p>
				<p class="storecatd_p3">价格：{{$ticket->price}}</p>
				<a href="javascript:;" @if($ticket->switch == '') class="storecatd_p4" @else class="storecatd_p0" @endif   id="{{$ticket->id}}"onClick="ticketSwitch({{ $ticket->id }})" >@if($ticket->switch == '') 销售中{{$ticket->switch}} @else 暂停销售 @endif</a>

				<a class="storecatd_p5" href="javascript:;" onclick="btnClick({{$ticket->id}})">删除</a>
			</div>
		@endforeach
		
	</div>
	<a href="{{route('items.create')}}?store_id={{$store->id}}" class="updata_salenum">新增</a>
</div>

<script type="text/javascript">
	function ticketSwitch(id)
	{
		$.ajax({
			url:'/items/'+id,
			type:'PATCH',
			data:{
				'_token' : '{{csrf_token()}}',
			},
			success: function(data)
			{
				if(data == 1){
					$('#'+id).removeClass('storecatd_p4').addClass('storecatd_p0')
					$('#'+id).text('暂停销售')
				}else{
					$('#'+id).removeClass('storecatd_p0').addClass('storecatd_p4')
					$('#'+id).text('销售中')

				}
			}
		})
	}
	//删除票卡
	$('.message_del').click(function(){
			$('.del_prompt').css('display','none') ;
			$.ajax({
				url : '/items/'+$('.message_del').attr('data_id'),
				type: 'DELETE',
				data: {
					'_token':'{{csrf_token()}}',
				},
				success : function(data){
					if(data){
						$('#ticket'+$('.message_del').attr('data_id')).remove()
					}
				}
			})
		})
</script>
@stop