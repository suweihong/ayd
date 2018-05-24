@extends('store._second')
	@section('main')
	<!-- <h1>管理员设置</h1> -->
	<div class="row">
		<div class="col-xs-12 in_box">
			<div class="col-xs-12">
				<label class="form-inline col-xs-12 form-inline-g">
					<span class="col-xs-1">账号 </span>
					<input type="text" class="form-control col-xs-6" placeholder="到佛山东莞佛山东莞"/>
				</label> 
				<label class="form-inline col-xs-12 form-inline-g">
					<span class="col-xs-1">密码 </span>
					<input type="text" class="form-control col-xs-6" placeholder="澳方体育馆"/>
					<u href="" style="margin:10px;color: #428bca">重置为: 123456</u>
				</label>  
				<a href="{{ route('stores.index')}}" class="btn btn-info" style="margin: 70px">　保存　</a>
			</div>
		</div>
	</div>
@stop