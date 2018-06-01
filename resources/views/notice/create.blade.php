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

		<div class="content" style="width:800px;">
					{{-- <h2>wangEditor example</h2> --}}
			<h3 class="page-header">公告内容：</h3>
			{!! we_field('wangeditor', 'content', '') !!}
			{!! we_config('wangeditor') !!}
		</div>
			


		<button class="btn btn-primary" type="submit" style="margin-top: 30px;margin-left: 380px;">提交</button>

	</form>
	<a href="{{route('notices.index')}}" ><button class="btn btn-danger" style="margin-left: 460px;margin-top: -51px;">返回</button></a>
</div><!--/.row-->
@stop