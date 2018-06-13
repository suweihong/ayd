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
		
		<div>
			<h3><font color="#c2c2c2">@if($type == '1')反馈商家：@else举报商家：@endif {{$complaint->store->title}}</font></h3>
			<h3><font color="#c2c2c2">@if($type == '1')反馈类型：@else举报类型：@endif {{$complaint->kind->name}}</font></h3>
			<h3><font color="#c2c2c2">@if($type == '1')反馈内容：@else举报原因：@endif {{$complaint->content}}</font></h3>
		</div>

		<div>
			<form method="post" action="{{ route('messages.store')}}"name='form'>
				@if($message)
					<textarea style="text-indent: 0px;background-color: #f2f2f2;margin-top: 50px;" name="reply_content" rows="10" cols="110">{{$message->content}}</textarea>
				@else
					<textarea style="text-indent: 0px;background-color: #f2f2f2;margin-top: 50px;" name="reply_content" placeholder="您的反馈信息已收到"  rows="10" cols="110"></textarea>

				@endif
				
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="id" value="{{$complaint->id}}">
				<input type="hidden" name="mp_user_id" value="{{$complaint->mp_user_id}}">

				<a href="javascript:document.form.submit()" class="form_name_back">确认回复</a>
			</form>
			
		</div>
			
	</div>

@stop
   