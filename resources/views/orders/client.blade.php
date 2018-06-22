@extends('layouts.layout')

@section('title','订单管理')

@section('content')
	<!-- <h1>按用户订单</h1> -->
	<div class="con_right storemanage"">
		<h1 class="in_title">订单查询</h1>
		<div class="search">
			@if($store == 1)
				<select class="searchstyle" name="store_id">
					@foreach($stores as $store)
						<option value="{{$store->id}}">{{$store->title}}</option>
					@endforeach
				</select>
			@else
				<select class="searchstyle" name="store_id">
					@foreach($clients as $client)
						<option value="{{$client->id}}">{{$client->nick_name}}</option>
					@endforeach
				</select>
			@endif
			<input type="text" readonly="readonly" class="demo-input searchstyle laydate_2" >
			<select class="searchstyle searchstyle_w">
				<option value="">羽毛球</option>
				<option value="">足球</option>
			</select>
			<a href="javascript:;" class="search_jian">检索</a>
			<a href="javascript:;" class="search_add_out">导出当前数据</a>
		</div>
		<p class="changguan">场馆：奇乐健身中心</p>
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
		    <tr>
		      <td>1</td>
		      <td>起了健身中心</td>
		      <td>正常</td>
		      <th>健身</th>
		      <th>aysd</th>
		      <td>2018-12-12 12:12</td>
		      <th>管理商家</th>
		    </tr>
		</table>
	</div>
@stop