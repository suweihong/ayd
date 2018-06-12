@extends('layouts.layout')
@section('title','公告管理')
@section('content')


	<div class="con_right storemanage" style="display: none;">
		@include('_messages')
		@include('_delete')

		<h1 class="in_title">公告列表</h1>
		<h3><a href="{{route('notices.create')}}"><button class="btn btn-primary">添加公告</button></a></h3>

	<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="col-lg-12">
				
			</div>
					<div class="panel-body">
						<table  width='600' border='1' height='150' style="margin:auto;text-align:center;">
						    <thead>
						    <tr height='40'>
						        <th  width='200' style="text-align:center;" >ID</th>
						        <th data-field="id" data-sortable="true" width='200' style="text-align:center;">标题</th>
						        <th data-field="name"  data-sortable="true" width='200' style="text-align:center;">操作</th>
						       
						    </tr>
						    </thead>
						     <tbody>
						    	@foreach($notices as $notice)
						    		<tr height='40'>
						    			<td>{{$notice->id}}</td>
						    			<td>{{$notice->title}}</td>
						    			<td>
						    				<button class="btn btn-danger btn-sm" onclick="btnClick({{$notice->id}})">删除</button>
											<a href="{{route('notices.edit',$notice->id)}}"><button class="btn btn-primary btn-sm">修改</button></a>
						    			</td>
						    		</tr>
						    	@endforeach
						    </tbody>
						</table>
					</div>
				</div>
			</div>
	</div><!--/.row-->	
		{!! $notices->render() !!}

	</div>
<script type="text/javascript">
	 function btnClick(id){
			$('.del_prompt').css('display','block') ;
			$('.message_del').attr('data_id',id);
			$('.del_cancle').click(function(){
				$('.del_prompt').css('display','none') ;
			})
	};

	$('.message_del').click(function(){
				$('.del_prompt').css('display','none') ;
				$.ajax({
					url :'/notices/'+ $('.message_del').attr('data_id'),
					type : 'DELETE',
					data :{
						'_token': "{!! csrf_token() !!}",
						},
					success : function(data){
						if(data){
							location.reload();
						}
					}
				})
		})
</script>
@stop