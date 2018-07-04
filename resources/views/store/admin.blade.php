@extends('layouts.layout')

@section('title','商家管理')

@section('content')
	<div class="con_right storebase">
		@include('_messages')
		@include('store._first',['shadow'=>1,'store_id'=>$store->id])
		@include('store._second',['shadow'=>2,'store_id'=>$store->id ])
		<form method="post" action="{{route('mpusers.store')}}" class="store_base_msg" name="form">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="store_id" value="{{$store->id}}">
			<div class="form_name">
				<span class="form_name_n">账号</span>
				@if($store->mp_user)
					<input type="text" class="form_name_ipt"  placeholder="奥方体育馆" name="account" value="{{ old('account',$store->mp_user->account) }}">
				@else
					<input type="text" class="form_name_ipt"  placeholder="请设置账号（手机号）" name="account" value="{{ old('account') }}">
				@endif
			</div>
			<div class="form_name">
				<span class="form_name_n">密码</span>

				
				@if($store->mp_user)	
					<input type="password" class="form_name_ipt"  placeholder="******" name="password"  value="{{ old('password') }}">
					<u style="color: #30a5ff;cursor: pointer;" onclick="rePassword({{$store->mp_user->id}})">重置为：1235456</u>
				@else
					<input type="password" class="form_name_ipt"  placeholder="请输入6位数字" name="password"  value="{{ old('password') }}">
					<u style="color: #30a5ff;cursor: pointer;" onclick="rePassword('aaa')">重置为：1235456</u>
				@endif
			</div>
			<a href="javascript:document.form.submit();" class="form_name_submitn">保存</a>
		</form>
	</div>

	<script type="text/javascript">
		//重置密码为123456
		function rePassword(id){
			setTimeout(() => {
	  			$("#error_messages").slideUp()
	  		}, 2000)
			$.ajax({
				url : '/mpusers/'+id,
				type : 'PATCH',
				data : {
					'_token' : '{{csrf_token()}}',
				},
				success : function(data){
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
		}
	</script>
@stop