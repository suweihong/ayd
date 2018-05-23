@extends('layouts.layout')

@section('title','添加运动品类')

@section('content')
		<div class="row">
			<div class="col-xs-12 in_box">
				<div class="alert" role="alert">
					<span class="in_title">运动品类</span>
				</div>
				<a href="{{ route('types.create')}}" class="btn btn-info">　　新增　　</a>
			</div>
		</div>	
@stop