<!-- {{-- 继承  基础信息管理  管理员管理 员工管理 --}} -->
@extends('store._first')
@section('substance')
	
	<div>
		<a href="{{route('stores.edit',1)}}">基础信息管理</a>
		<a href="{{route('mpusers.create')}}">管理员管理</a>
		<a href="{{route('staffs.index')}}">员工管理</a>
	 </div>
	<div>@yield('main')</div>
@stop