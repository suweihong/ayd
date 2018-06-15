
@extends('layouts.layout')

@section('title','评价审核')

@section('content')
	<div class="con_right storeorder">
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
						<span class="evaluatenum">5分</span>
						<p class="evalua">{{$estimate->content}}</p>
						@if($estimate->check_id == 6)
							<a href="javascript:;" class="pass">审核通过</a>
						@elseif($estimate->check_id == 5)
							<a href="javascript:;" class="nopass">审核未通过</a>
						@else
							<a href="javascript:;" class="review1">通过</a>
							<a href="javascript:;" class="review2">拒绝</a>
						@endif
						<a href="javascript:;" class="delete" onClick='delEstimate({{$estimate->id}})'>删除</a>
					</div>
					<div class="laiyuan">
						<p class="source">评价来源</p>
						<p>商家: <a href="javascript:;">{{$estimate->store->title}}</a></p>
						<p>订单: <a href="javascript:;">123123</a></p>
						<p class="evatime">评价时间:  {{$estimate->created_at}}</p>
					</div>
				</div>
			@endforeach
		</div>
		{{ $estimates->appends(['check_id'=>$check_id])->render() }}
	</div>
	
	<script type="text/javascript">
		function delEstimate(id)
		{
			$.ajax({
				url : '/estimate/'+id,
				type : 'DELETE',
				data : {
					'_token' : '{{csrf_token()}}'
				},
				success : function(data)
				{
					console.log(data)
				}
			})
		}
	</script>
@stop
