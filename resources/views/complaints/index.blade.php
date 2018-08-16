@extends('layouts.layout')
@section('title','服务中心')
@section('content')

<div class="con_right storemanage">

		@include('_messages')
		@include('_delete')
				

		@if($type == 2)
			<h1 class="in_title">用户投诉</h1>
		@else
			<h1 class="in_title">商家反馈</h1>
		@endif
		<table border="1" class="table_line">
			<tr>
			    <th>序号</th>
			    <th>用户名</th>
			    @if($type == 2)
				    <th>举报场馆</th>
				@endif
			    <th>类型</th>
			    <th>处理状态</th>
			    <th>反馈情况</th>
		    </tr>
			@foreach($complaints as $key => $complaint)
	    		<tr>
	    			<td>{{$key+1}}</td>
	    			@if($type == 1)
	    				<td>{{$complaint->store->title}}</td>
	    			@else
	    				<td>{{$complaint->user->nick_name}}</td>
	    				<td>{{$complaint->store->title}}</td>
	    			@endif
	    			<td>{{$complaint->kind->name}}</td>
	    			<td>{{$complaint->check->name}}</td>
	    			<td>
						<a href="{{route('complaints.show',[$type,$complaint->id])}}">查看详情</a>
	    			</td>
	    		</tr>
			@endforeach
			   
		</table>
	{!! $complaints->render() !!}
</div>

<script type="text/javascript">
		$('td').each(function(){
			if($(this).html()=='未处理'){
				$(this).css('color','red');
			}
		})
		
</script>

@stop