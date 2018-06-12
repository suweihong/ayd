@extends('layouts.layout')

@section('title','添加运动品类')

@section('content')
	
	<div class="con_right  sportStyle">

		@include('_messages')
		@include('_delete')

		<h1 class="in_title">运动品类</h1>
		<a href="{{ route('types.create')}}" class="addsport">新增</a>
		<table border="1" class="table_line">
		    <thead>
		    <tr height='40'>
		        <th  width='200' style="text-align:center;">编号</th>
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
		   					<a href="{{route('stores.index')}}?type_id={{$type->id}}" >关联商家</a>
							<button class="btn btn-info btn-sm" >编辑</button>
							<button class="btn btn-danger btn-sm" onclick="btnClick({{$type->id}})">删除</button>
		    			</td>
		    		</tr>
		    	@endforeach
		    </tbody>
		</table>
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
		//删除运动品类
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