@extends('layouts.layout')

@section('title','商家管理')

@section('content')


	<!-- <h1>员工管理</h1> -->
	<div class="con_right storebase" >
		@include('_messages')
		@include('_delete')
		@include('store._first',['shadow'=>1,'store_id'=>$store->id])
		@include('store._second',['shadow'=>3,'store_id'=>$store->id])
		<div class="store_base_starf">
			<div class="starflist">
				@foreach($staffs as $staff)
					<div class="starflist_item" id="{{$staff->id}}" onclick="btnClick({{$staff->id}})">
						<div class="masked">删除</div>
						<img src="{{$staff->img}}">
						<p class="starf_name">{{$staff->name}}</p>
					</div>
				@endforeach
			</div>
			<div class="mask_codebox">
				<img src="img/erweima.jpg" alt="">
				<p>请使用微信扫描以上二维码完成绑定</p>
				<a href="javascript:;" class="form_name_close">关闭</a>
			</div>
			<a href="javascript:;" class="form_name_submitn form_name_newadd" type="submit">新增员工</a>
		</div>
	</div>

	<script type="text/javascript">
		//删除员工
		$('.message_del').click(function(){
			$('.del_prompt').css('display','none') ;
			setTimeout(() => {
	  			$("#error_messages").slideUp()
	  		}, 2000)
			$.ajax({
				'url' : '/staffs/'+$('.message_del').attr('data_id'),
				'type' : 'DELETE',
				'data' : {
					'_token' : '{{csrf_token()}}',
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