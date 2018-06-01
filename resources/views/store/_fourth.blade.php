
@if($switch == 0)
	<div class="row">
		<div class="col-xs-12 in_box">
			
			<ul id="store_menu1" class="col-xs-12">
				<li @if($shadow == 1) class="active" @endif><a href="{{route('fields.create')}}">按星期</a></li>
				<li @if($shadow == 2) class="active" @endif><a href="/price/date">按日期</a></li>
				
			</ul>
		</div>
	</div>
@else
		<div class="row">
		<div class="col-xs-12 in_box">
			
			<ul id="store_menu1" class="col-xs-12">
				<li @if($shadow == 1) class="active" @endif><a href="{{route('fields.show',1)}}">按星期</a></li>
				<li @if($shadow == 2) class="active" @endif><a href="/switch/date">按日期</a></li>
				
			</ul>
		</div>
	</div>
@endif
