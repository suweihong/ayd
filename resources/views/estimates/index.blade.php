@extends('layouts.layout')

@section('title','商家管理')

@section('content')
	<div class="con_right storeevaluate">
		@include('store._first',['shadow'=>4,'store_id'=>$store->id])
		<div class="evaluate">
			<h3>综合评分: {{$average}}分</h3>
			<h4>环境评价: {{$environment}}分</h4>
			<h4>服务评价: {{$service}}分</h4>
			<h3>最近评价</h3>
			@foreach($estimates as $estimate)
				<div class="eavbox" style="font-size:20px">
					<span>{{$estimate->client->nick_name}}</span>
					<span style="color:#F00">{{$estimate->average}}分</span>
					<p class="evalua">{{$estimate->content}}</p>
					<p class="evatime">{{$estimate->created_at}}</p>
				</div>
			@endforeach
		</div>
	</div>
	{{ $estimates->render() }}
@stop