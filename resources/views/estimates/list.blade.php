
@extends('layouts.layout')

@section('title','评价审核')

@section('content')
	<div class="con_right storeorder">
		@include('_delete')
		@include('_messages')
		<h1 class="in_title">评价审核</h1>
		<div class="storemenu1">
			<a href="{{route('estimates.index')}}?check_id=3" @if($check_id == 3) class="active" @endif>未审核</a>
			<a href="{{route('estimates.index')}}?check_id=5" @if($check_id == 5) class="active"  @endif>已审核</a>
			<a href="{{route('estimates.index')}}?check_id=33" @if($check_id == 33) class="active" @endif>全部</a>
		</div>
		<div class="evaluate">
			@foreach($estimates as $estimate)
				<div class="eavbox" id="{{$estimate->id}}">
					<div class="xinxi">
						<span>{{$estimate->client->nick_name}} </span>
						<span class="evaluatenum">{{$estimate->average}}分</span>
						<p class="evalua">{{$estimate->content}}</p>
						@if($estimate->check_id == 6)
							<a href="javascript:;" class="pass">审核通过</a>
						@elseif($estimate->check_id == 5)
							<a href="javascript:;" class="nopass">审核未通过</a>
						@else
							<a href="javascript:;" class="review1" onclick="estimatePass({{$estimate->id}},1)">通过</a>
							<a href="javascript:;" class="review2" onclick="estimatePass({{$estimate->id}},2)">拒绝</a>
						@endif
						<a href="javascript:;" class="delete" 
						onclick="btnClick({{$estimate->id}})">删除</a>
					</div>
					<div class="laiyuan">
						<p class="source">评价来源</p>
						<p>商家: <a href="{{route('estimates.index')}}?store_id={{$estimate->store->id}}">{{$estimate->store->title}}</a></p>
						<p>订单: <a href="{{route('orders.show',$estimate->order_id)}}">{{$estimate->order_id}}</a></p>
						<p class="evatime">评价时间:  {{$estimate->created_at}}</p>
					</div>
				</div>
			@endforeach
		</div>
		{{ $estimates->appends(['check_id'=>$check_id])->render() }}
	</div>
	
	<script type="text/javascript">
		//删除评价
		$('.message_del').click(function(){
			$('.del_prompt').css('display','none') ;
				setTimeout(() => {
			  	$("#error_messages").slideUp()
			  	}, 2000)
			$.ajax({
				url : '/estimates/'+$('.message_del').attr('data_id'),
				type: 'DELETE',
				data: {
					'_token':'{{csrf_token()}}',
				},
				success : function(data){
					$('#'+$('.message_del').attr('data_id')).remove()
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
		})
		//改变评价的审核状态
		function estimatePass(id,e){
			$('.del_prompt').css('display','none') ;
				setTimeout(() => {
			  	$("#error_messages").slideUp()
			  	}, 2000)

			 $.ajax({
			 	url : "/estimates/"+id,
			 	type : 'PATCH',
			 	data:{
			 		'_token' : '{{csrf_token()}}',
			 		'check_id' : e,
			 	},
			 	success : function(data){
			 		console.log(data)
			 		$('#'+id).remove()
			 		$('#'+$('.message_del').attr('data_id')).remove()
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
