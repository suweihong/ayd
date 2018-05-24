
@extends('store._first')
@section('substance')
	<div class="row">
		<div class="col-xs-12 in_box">
			<ul id="store_menu1" class="col-xs-12">
				<li class="active"><a href="{{route('stores.edit',1)}}">基础信息管理</a></li>
				<li><a href="{{route('mpusers.create')}}">管理员设置</a></li>
				<li><a href="{{route('staffs.index')}}">员工管理</a></li>
			</ul>
		</div>
	</div>
	<div>@yield('main')</div>
@stop