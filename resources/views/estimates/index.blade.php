@extends('layouts.layout')

@section('title','商家管理')

@section('content')
	
	@include('store._first',['shadow'=>4,'store_id'=>$store->id])
	
	<div class="row evaluate">
		
		<h3>综合评分: 4.6分</h3>
		<h4>环境评价: 4.2分</h4>
		<h4>服务评价: 4.8分</h4>
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

	{{ $estimates->render() }}
@stop