@extends('layouts.layout')
@section('title','服务中心')
@section('content')

	<div class="row">
		@include('_messages')
			<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header">商家反馈</h3>
				</div>
			</div><!--/.row-->

			<div class="col-lg-12">
				<h3><font color="#c2c2c2">反馈商家：{{$complaint->store->title}}</font></h3>
				<h3><font color="#c2c2c2">反馈类型：{{$complaint->kind->name}}</font></h3>
				<h3><font color="#c2c2c2">反馈内容：{{$complaint->content}}</font></h3>
			</div>

			
			
	</div>

@stop