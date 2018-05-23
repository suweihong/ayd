@extends('layouts.layout')
@section('title','服务中心')
@section('content')

<div class="row">
			@include('_messages')

		
		@include('_delete')
	{{-- 	<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header"><a href="{{route('complaints.create')}}"><button class="btn btn-primary">添加公告</button></a></h3>
			</div>
		</div><!--/.row--> --}}
				
	

	<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">商家反馈</div>
					<div class="panel-body">
						<table   border='1' height='150' style="margin:auto;text-align:center;">
						    <thead>
						    <tr height='40'>
						        <th  width='200' style="text-align:center;" >编号</th>
						        <th data-field="id" data-sortable="true" width='200' style="text-align:center;">用户名</th>
						        @if($type == 2)
						        	<th width='200' style="text-align:center;">举报场馆</th>
						        @endif
						        <th data-field="name"  data-sortable="true" width='200' style="text-align:center;">类型</th>
						         <th data-field="id" data-sortable="true" width='200' style="text-align:center;">处理状态</th>
						        <th data-field="name"  data-sortable="true" width='200' style="text-align:center;">反馈情况</th>
						       
						    </tr>
						    </thead>
						     <tbody>
						    	@foreach($complaints as $complaint)
						    		<tr height='55'>
						    			<td>{{$complaint->id}}</td>
						    			@if($type == 1)
						    				<td>{{$complaint->store->title}}</td>
						    			@else
						    				<td>{{$complaint->client->nick_name}}</td>
						    				<td>{{$complaint->store->title}}</td>
						    			@endif
						    			
						    			
						    			<td>{{$complaint->kind->name}}</td>
						    			<td>{{$complaint->check->name}}</td>
						    			<td>
						    				{{-- <button class="btn btn-danger btn-sm" onclick="btnClick({{$complaint->id}})">删除</button> --}}
											<a href="{{route('complaints.show',[$type,$complaint->id])}}">查看详情</a>
						    			</td>
						    		</tr>
						    	@endforeach
						    </tbody>
						</table>
					</div>
				</div>
			</div>
	</div><!--/.row-->	
		
		{!! $complaints->render() !!}

</div><!--/.row-->

<script type="text/javascript">
		$('td').each(function(){
			if($(this).html()=='未处理'){
				$(this).addClass('passtd')
			}
		})
		
</script>

@stop