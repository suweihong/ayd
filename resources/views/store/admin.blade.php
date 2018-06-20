@extends('layouts.layout')

@section('title','商家管理')

@section('content')
	<div class="con_right storebase">
		@include('_messages')
		@include('store._first',['shadow'=>1,'store_id'=>$store->id])
		@include('store._second',['shadow'=>2,'store_id'=>$store->id ])
		<form method="post" action="{{route('mpusers.store')}}" class="store_base_msg" name="form">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="store_id" value="{{$store->id}}">
			<div class="form_name">
				<span class="form_name_n">账号</span>
				@if($store->mp_user)
					<input type="text" class="form_name_ipt"  placeholder="奥方体育馆" name="account" value="{{ old('account',$store->mp_user->account) }}">
				@else
					<input type="text" class="form_name_ipt"  placeholder="请设置账号" name="account" value="{{ old('account') }}">
				@endif
			</div>
			<div class="form_name">
				<span class="form_name_n">密码</span>
				<input type="password" class="form_name_ipt"  placeholder="**********" name="password"  value="{{ old('password') }}">
				<u style="color: #30a5ff;cursor: pointer;">重置为：1235456</u>
			</div>
			<a href="javascript:document.form.submit();" class="form_name_submitn">保存</a>
		</form>
	</div>
@stop