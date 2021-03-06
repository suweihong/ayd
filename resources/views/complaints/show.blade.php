@extends('layouts.layout')
@section('title','服务中心')
@section('content')

	<div class="con_right storemanage">
		@include('_messages')

		@if($type == 1)
			<h1 class="in_title">商家反馈</h1>
		@else
			<h1 class="in_title">用户投诉</h1>
		@endif
		
		<div class="store_divt">
			<h3><font color="#c2c2c2">@if($type == '1')反馈商家：@else举报商家：@endif {{$complaint->store->title}}</font></h3>
			<h3><font color="#c2c2c2">@if($type == '1')反馈类型：@else举报类型：@endif {{$complaint->kind->name}}</font></h3>
			<h3><font color="#c2c2c2">@if($type == '1')反馈内容：@else举报原因：@endif {{$complaint->content}}</font></h3>
		</div>

		<div class="store_divt">
			<form method="post" action="{{ route('messages.store')}}" name='form'>
				@if($message)
					<textarea class="texbox" name="reply_content" rows="10" cols="110">{{$message->content}}</textarea>
				@else
					<textarea class="texbox" name="reply_content" placeholder="您的反馈信息已收到"  rows="10" cols="110"></textarea>

				@endif
				
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="id" value="{{$complaint->id}}">
				@if($type == 1)
					<input type="hidden" name="mp_user_id" value="{{$complaint->mp_user_id}}">
				@else
					<input type="hidden" name="user_id" value="{{$complaint->user_id}}">
				@endif

				<a class="btnorder_details" href="javascript:document.form.submit()" class="form_name_back">确认回复</a>
			</form>
			
		</div>
			
	</div>

@stop
   