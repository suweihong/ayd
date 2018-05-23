@extends('layouts.layout')
@section('title','公告管理')
@section('content')

<div class="row">
		
	@include('_messages')


	<form method="post" action="{{route('notices.update',$notice->id)}}">	
		<input type="hidden" name="_method" value="PUT">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">公告标题：<input name="title" value="{{$notice->title}}"></input></h3>

			</div>
		</div><!--/.row-->

		
					{{-- <h2>wangEditor example</h2> --}}
			<h3 class="page-header">公告内容：</h3>
			{!! we_field('wangeditor', 'content', '<p></p>') !!}
			{!! we_config('wangeditor') !!}


		<button class="btn btn-primary" type="submit">提交</button>
	</form>
</div><!--/.row-->
@stop