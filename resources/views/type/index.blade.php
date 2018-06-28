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
		    		<tr height='55' id="{{$type->id}}" >
		    			<td>{{$type->id}}</td>
		    			<td>{{$type->name}}</td>
		    			<td>{{$type->created_at}}</td>
		    			<td>
		   					<a href="{{route('stores.index')}}?type_id={{$type->id}}" >关联商家</a>
		   					<a href="javascript:;" class="ben_notice" onclick="btnClick({{$type->id}})">删除</a>
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
		setTimeout(() => {
	  			$("#error_messages").slideUp()
	  		}, 2000)
		$.ajax({
			url :'/types/'+ $('.message_del').attr('data_id'),
			type : 'DELETE',
			data :{
				'_token': "{!! csrf_token() !!}",
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
</script>

@stop