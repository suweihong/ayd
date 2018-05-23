@extends('layouts.layout')
@section('title','服务中心')
@section('content')

	<div class="row">
		@include('_messages')
			
			<div class="col-lg-12">
				<h2>{{$complaint->store->title}}</h2>
				<h3>反馈类型：{{$complaint->kind->name}}</h3>
				<h3>反馈内容：{{$complaint->content}}</h3>
			</div>
			<div class="col-md-6">
				<div class="panel panel-teal">
					<div class="panel-heading dark-overlay">Teal Panel</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
					</div>
				</div>
			</div><!--/.col-->
	</div>

@stop