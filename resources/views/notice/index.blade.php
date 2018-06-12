@extends('layouts.layout')
@section('title','公告管理')
@section('content')


	<div class="con_right storemanage" >
		@include('_messages')
		@include('_delete')

		<h1 class="in_title">公告列表</h1>
		<h3><a href="{{route('notices.create')}}" class="updata_salenum">添加公告</a></h3>

		<table border="1" class="table_line">
		    <tr>
		      <th>序号</th>
		      <th>名称</th>
		      <th>状态</th>
		      <th>销售项目</th>
		      <th>管理员</th>
		      <th>创建时间</th>
		      <th>操作</th>
		    </tr>
		    <tr>
		      <td>1</td>
		      <td>起了健身中心</td>
		      <td>正常</td>
		      <th>健身</th>
		      <th>aysd</th>
		      <td>2018-12-12 12:12</td>
		      <th><a href="javascript:;">管理商家</a></th>
		    </tr>
		</table>

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