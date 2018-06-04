
@if($switch == 0)
	<ul class="nav nav-pills" id="store_menu2">
		<li class="active btn"><a href="{{route('fields.create')}}" class="btnt">按星期</a></li>
		<li class="btn">
		<!-- <a href="/price/date" class="btnt" style="position: absolute;z-index: 9">按日期</a> -->

			<a href="javascript:void(0);" class="btnt btn_date" style="position: absolute;z-index: 9">按日期</a>
				<input type="text" class="demo-input" id="test1" value="{{$now}}">

		</li>
	</ul>
@else
	<ul class="nav nav-pills" id="store_menu2">
		<li class="active btn"><a href="{{route('fields.show',1)}}" class="btnt">按星期</a></li>
		<li class="btn">
			<a href="/switch/date" class="btnt" style="position: absolute;z-index: 9">按日期</a>
			<input type="text" class="demo-input" id="test1" value="{{$now}}">
		</li>
	</ul>
@endif

<script type="text/javascript">
	var day = $('.layui-this').attr('lay-ymd');
	var aa = 333;
	$('.btn_date').click(function(){
			alert(day);
	})
</script>
