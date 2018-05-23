@extends('layouts.layout')
@section('title','公告管理')
@section('content')

<div class="row">
		
	@include('_messages')


	<form method="post" action="{{route('notices.store')}}">	
		{{ csrf_field() }}

		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">公告标题：<input name="title" value=""></input></h3>

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