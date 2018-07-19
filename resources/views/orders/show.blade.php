@extends('layouts.layout')

@section('title','订单管理')

@section('content')
	<div class="con_right storemanage">
		@include('_messages')
		<h1 class="in_title">订单详情</h1>
		<p class="order_details">订单号：{{$orders->id}}</p>
		<p class="order_details">场馆：{{$orders->store->title}}</p>
		<p class="order_details">订单信息：{{$orders->date->format('Y年m月d日')}}@foreach($fields as $field)<br>　　　　　场地{{$field->place_num}}（{{$field->time}}：00-{{$field->time + 1}}：00）@endforeach</p>
		<p class="order_details">购买人:@if($orders->client) {{$orders->client->nick_name}} @endif</p>
		<p class="order_details">联系电话：{{$orders->phone}}</p>
		<p class="order_details">订单状态：{{$orders->new_status()->name}}</p>
		<button  class="order_detailsbtn"  onclick="order_hx({{$orders->id}})" >协助核销</button>
		<p class="order_details"><a href="javascript:history.back(-1)" class="btnorder_details">返回</a></p>
	</div>

	<script type="text/javascript">
		function order_hx(id)
		{
			setTimeout(() => {
	  			$("#error_messages").slideUp()
	  		}, 2000)
			$.ajax({
					url:'/orders/'+id,
					type : 'PUT',
					data: {
						'_token':'{{csrf_token()}}',
					},
					success : function(data){
						$('#error_messages').show()
						$('#error_messages .flash-message').remove()
						var tt=data.errmsg
						if(data.errcode==2){
							var classn="alert-warning"
						}else{
							var classn="alert-success"
						}
						var html='<div class="flash-message">\
							        <p class="alert '+classn+'">'+tt+'</p>\
						      	</div>'
						$('#error_messages').append(html)
					}
				})
		}

		
	</script>
@stop