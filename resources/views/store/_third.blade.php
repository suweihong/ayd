@extends('store._first')
@section('substance')
	
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-pills"  id="store_menu2">
				<li class="active btn" data-toggle="tab"><a href="#pilltab" >羽毛球</a></li>
				<li class="btn" data-toggle="tab"><a href="">健身</a></li>
				<li class="btn" data-toggle="tab"><a href="">足球</a></li>
				<li class="btn_add">新增</li>
			</ul>
		</div>
		<div class="col-xs-12">
			<ul id="store_menu1" class="col-xs-12">
				<li class="active"><a href="{{route('items.index')}}">场地配置</a></li>
				<li><a href="{{route('items.create')}}">价格配置</a></li>
				<li><a href="{{route('items.show',1)}}">场地管理</a></li>
			</ul>
		</div>
	</div>
	<div class="row col-sm-12">
		@yield('subject')
	</div>

@stop

