@extends('layouts.layout')

@section('title','添加运动品类')

@section('content')
	
	@include('_messages')
	@include('_delete')

		<div class="row">
			<div class="col-xs-12 in_box">
				<div class="alert" role="alert">
					<span class="in_title">运动品类</span>
				</div>
				<a href="{{ route('types.create')}}" class="btn btn-info">　　新增　　</a>
			</div>
		</div>

		<div class="row" style="margin-top: 20px;">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<table   border='1' height='150' style="margin:auto;text-align:center;">
						    <thead>
						    <tr height='40'>
						        <th  width='200' style="text-align:center;" >编号</th>
						        <th data-field="id" data-sortable="true" width='200' style="text-align:center;">名称</th>
						       
						        	<th width='200' style="text-align:center;">创建时间</th>
						      
						       
						        <th data-field="name"  data-sortable="true" width='200' style="text-align:center;">操作</th>
						       
						    </tr>
						    </thead>
						     <tbody>
						    	@foreach($types as $type)
						    		<tr height='55'>
						    			<td>{{$type->id}}</td>
						    		
						    			<td>{{$type->name}}</td>
						    		
						    			<td>{{$type->created_at}}</td>
						    			
						    			<td>
						   
											<a href="">关联商家</a>
											<button class="btn btn-info btn-sm" onclick="btnClick()">编辑</button>
											<button class="btn btn-danger btn-sm" onclick="btnClick()">删除</button>
											
						    			</td>
						    		</tr>
						    	@endforeach
						    </tbody>
						</table>
					</div>
				</div>
			</div>

	</div><!--/.row-->	
	<div class="row">
			{{ $types->render()}}		
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
					url :'/types/'+ $('.message_del').attr('data_id'),
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