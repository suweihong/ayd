@extends('layouts.layout')
@section('title','服务中心')
@section('content')

	<div class="row">
		@include('_messages')
			<div class="row">
				<div class="col-lg-12">
					@if($type == 1)
						<h3 class="page-header">商家反馈</h3>
					@else
						<h3 class="page-header">用户投诉</h3>
					@endif
				</div>
			</div><!--/.row-->

			<div class="col-lg-12">
				<h3><font color="#c2c2c2">@if($type == '1')反馈商家：@else举报商家：@endif {{$complaint->store->title}}</font></h3>
				<h3><font color="#c2c2c2">@if($type == '1')反馈类型：@else举报类型：@endif {{$complaint->store->title}}</font></h3>
				<h3><font color="#c2c2c2">@if($type == '1')反馈内容：@else举报原因：@endif {{$complaint->store->title}}</font></h3>
			</div>
		
			<div class="col-lg-12">
				<form method="post" action="{{ route('messages.store')}}">
					@if($message)
						<textarea style="text-indent: 0px;background-color: #f2f2f2;margin-top: 50px;" name="reply_content" placeholder="{{$message->content}}"  rows="10" cols="110"></textarea>
					@else
						<textarea style="text-indent: 0px;background-color: #f2f2f2;margin-top: 50px;" name="reply_content" placeholder="您的反馈信息已收到"  rows="10" cols="110"></textarea>

					@endif
					
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="id" value="{{$complaint->id}}">
					<input type="hidden" name="mp_user_id" value="{{$complaint->mp_user_id}}">

					<button class="btn btn-info" style='margin-top: 70px;margin-left: -460px;'>确认回复</button>
				</form>
				
			</div>
			
	</div>

@stop
   