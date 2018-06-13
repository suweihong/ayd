@extends('layouts.layout')
@section('title','公告管理')
@section('content')


	<div class="con_right storemanage" >
		@include('_messages')
		@include('_delete')

		<h1 class="in_title">公告列表</h1>
		<label class="title"><a href="{{route('notices.create')}}">添加公告</a></label>

		<table border="1" class="table_line">
		    <tr>
		      <th>序号</th>
		      <th>标题</th>
		      <th>操作</th>
		    </tr>
		    @foreach($notices as $notice)
				<tr>
	    			<td>{{$notice->id}}</td>
	    			<td>{{$notice->title}}</td>
	    			<td>
	    				<button onclick="btnClick({{$notice->id}})">删除</button>
						<a href="{{route('notices.edit',$notice->id)}}">修改</a>
	    			</td>
    			</tr>
    		@endforeach
		</table>
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