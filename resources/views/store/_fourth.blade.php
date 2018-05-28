@extends('store._third')
@section('subject')
		<div class="row">
		<div class="col-xs-12">
			<ul>
				<li><a href="{{route('fields.create')}}" >按星期</a></li>
				<li ><a href="/price/date">按日期</a></li>
			
			</ul>
		</div>
	</div>
	<div class="row col-sm-12">
		@yield('part')
	</div>

@stop