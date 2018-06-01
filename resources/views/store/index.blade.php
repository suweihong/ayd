@extends('layouts.layout')

@section('title','商家管理')

@section('content')
	<div class="row">
		
		@include('_messages')

		<div class="col-xs-12 in_box">
			<div class="alert" role="alert">
				<span class="in_title">商家管理</span>
			</div>
			<div class="col-xs-12">
				<form action="{{route('stores.index')}}" method="get">
					<input type="text" class="col-xs-3  btn " name="search_name" placeholder="按名称检索"  value="{{ old('search_name') }}">
					<div class="form-group col-xs-3">
						<select class="form-control " name="store_type" >
						    <option value="1">签约商家</option>
						    <option value="2">锁定商家</option>
						</select>  
					</div>
					<button class="btn btn-info col-xs-1 " >检索</button>
					<a href="{{route('stores.create')}}" class="btn clickt col-xs-1">新增</a>
				</form>
				
				
				
			</div>
		</div>

	<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<table   border='1' height='150' style="margin:auto;text-align:center;">
						    <thead>
						    <tr height='40'>
						        <th  width='200' style="text-align:center;" >序号</th>
						        <th data-field="id" data-sortable="true" width='200' style="text-align:center;">名称</th>
						        <th data-field="name"  data-sortable="true" width='200' style="text-align:center;">状态</th>
						         <th data-field="name"  data-sortable="true" width='200' style="text-align:center;">销售项目</th>
						         <th data-field="name"  data-sortable="true" width='200' style="text-align:center;">管理员</th>
						          <th data-field="name"  data-sortable="true" width='200' style="text-align:center;">创建时间</th>
						           <th data-field="name"  data-sortable="true" width='200' style="text-align:center;">操作</th>
						           
						       
						    </tr>
						    </thead>
						     <tbody>
						    	@foreach($stores as $store)
						    		<tr height='40'>
						    			<td>{{$store->id}}</td>
						    			<td>{{$store->title}}</td>
						    			@if($store->switch == 1)
						    			<td>正常</td>
						    			@else
						    			<td>锁定</td>
						    			@endif
						    			
						    			<td>
						    				@foreach($store->types as $type)
						    				 {{$type->name}} 
						    				@endforeach
						    			</td>
										@if($store->mp_user)
											<td>{{$store->mp_user->account}}</td>
										@else
											<td></td>
										@endif
										<td>{{$store->created_at}}</td>	
						    			<td>
						    				
											<a href="{{route('stores.edit',$store->id)}}">管理商家</a>
						    			</td>
						    		</tr>
						    	@endforeach
						    </tbody>
						</table>
					</div>
				</div>
			</div>
	</div><!--/.row-->	
		{!! $stores->render() !!}

	</div>

	<script type="text/javascript">
		$('td').each(function(){
			if($(this).html()=='锁定'){
				$(this).css('color','red');
			}
		})
		
</script>

@stop