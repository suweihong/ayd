@extends('layouts.layout')
@section('title','公告管理')
@section('content')

<div  class="con_right">
		
	@include('_messages')

	<h1 class="in_title">添加公告</h1>
	<form method="post" action="{{route('notices.update',$notice->id)}}">
		<input type="hidden" name="_method" value="PUT">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form_name">
			<span class="form_name_n">公告标题：</span>
			<input name="title" value="{{ old('title')  or $notice->title}}">
		</div> 

		<div class="form_name">
			
			<span class="form_name_n">公告内容：</span>
			{!! we_field('wangeditor', 'content',$notice->content) !!}
			{!! we_config('wangeditor') !!}
		</div>
		<a href="javescript:document.form.submit()" class="">提交</a>
	</form>
</div>
@stop