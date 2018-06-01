@extends('store._third')
@section('subject')
	<ul class="nav nav-pills" id="store_menu2">
		<li class="active btn"><a href="{{route('fields.show',1)}}" class="btnt">按星期</a></li>
		<li class="btn">
			<a href="/switch/date" class="btnt" style="position: absolute;z-index: 9">按日期</a>
			<input type="text" class="demo-input" id="test1" value="2018-06-01">
		</li>
	</ul>
	<div class="row col-sm-12">
		@yield('part')
	</div>



@stop