@extends('layouts.layout')

@section('title','添加运动品类')

@section('content')

	<div class="con_right  sportStyle">
		@include('_messages')
		<h1 class="in_title">销售分类</h1>
		<form name="form"  method="post" action="{{route('types.store')}}">
			<div class="sportadd">
				<span class="itemnane">分类名称</span>
				<input type="hidden" name="_token" value="{{ csrf_token()}}">
				<input type="text" name="type" value="{{ old('type') }}" class="iptstyle">

				<a href="javascript:document.form.submit();" class="addsport_t">新增</a>
			 </div>
		</form>
	</div>
@stop