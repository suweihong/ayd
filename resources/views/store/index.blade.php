@extends('layouts.layout')

@section('title','商家管理')

@section('content')

	<div class="con_right storemanage" >
		@include('_messages')
		<h1 class="in_title">商家管理</h1>
		<div class="search">
			<form name="form" action="{{route('stores.index')}}" method="get">
				<input class="searchstyle" type="text" name="search_name" placeholder="按名称检索【足球】" value="{{ old('search_name') }}">
				<select class="searchstyle" name="store_type">
					<option value="1" @if (old('province')) selected @endif>预约商家</option>
					<option value="2">锁定商家</option>
				</select>
				<a href="javascript:document.form.submit();" class="search_jian">检索</a>
				<a href="{{route('stores.create')}}" class="search_add">新增</a>
			</form>
		</div>
		<table border="1" class="table_line">
		    <tr>
		      <th>序号</th>
		      <th>名称</th>
		      <th>状态</th>
		      <th>销售项目</th>
		      <th>管理员</th>
		      <th>创建时间</th>
		      <th>操作</th>
		    </tr>
		  	@foreach($stores as $store)
    		<tr>
    			<td>{{$store->id}}</td>
    			<td>{{$store->title}}</td>

    			<td style="cursor: pointer;" onclick="store_switch({{$store->id}})" id="{{$store->id}}" @if($store->switch == 2) class="color_red" @endif>@if($store->switch == 1)正常 @else 锁定 @endif</td>
    			<td>
    			@foreach ($types_stores as $key => $types_store)
    				@if($key == $store->id)
    				<?php foreach ($types_store as $k => $type): ?>
    					{{$type->name}}
    				<?php endforeach ?>
    				@endif
    			@endforeach 
				</td>
				@if($store->mp_user)
					<td>{{$store->mp_user->account}}</td>
				@else
					<td></td>
				@endif
				<td>{{$store->created_at}}</td>	
    			<td>
					<a href="{{route('stores.edit',$store->id)}}">管理商家{{$store->switch}}</a>
    			</td>
    		</tr>
	   		@endforeach
		</table>
			{!! $stores->render() !!}
	</div>
	<script type="text/javascript">
		//改变店铺的状态
		function store_switch(id){
			$.ajax({
				'url' : '{{route("stores.show",1)}}',
				'type' : 'GET',
				'data' : {
					'store_id':id,
				},
				success : function(data){
					if(data == 1){
						$('#'+id).html('正常').removeClass('color_red')
					}else{
						$('#'+id).html('锁定').addClass('color_red')

					}
				}
			})
			
		}
	</script>

@stop