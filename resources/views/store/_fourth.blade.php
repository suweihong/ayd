
@if($switch == 0)
		<!-- 价格 -->
	<ul class="nav nav-pills" id="store_menu2">
		<li class="active btn"><a href="{{route('fields.create')}}" class="btnt">按星期</a></li>
		<li class="btn">

			<!-- <a href="/price/date" class="btnt" style="position: absolute;z-index: 9">按日期</a> -->
<form action="/price/date" method="get" name="form">
		<a href="javascript:document.form.submit();" class="btnt btn_date  price_date" style="position: absolute;z-index: 9">按日期</a>
		<input type="text" class="demo-input btn_date" id="test1" name="date" value="">
		<input type="hidden" name="type_id" value="{{$type_id}}"></input>
</form>


		</li>
	</ul>
@else
		<!-- 开关 -->
	<ul class="nav nav-pills" id="store_menu2">
		<li class="active btn"><a href="{{route('fields.show',1)}}" class="btnt">按星期</a></li>
		<li class="btn">
			<a href="/switch/date" class="btnt" style="position: absolute;z-index: 9">按日期</a>
			<input type="text" class="demo-input" id="test1" value="{{$now}}">
		</li>
	</ul>
@endif

<script type="text/javascript">

$('.btn_date').click(function(){
	console.log($('#test1').val())
});
	laydate.render({
			elem: '#test1',
		});

</script>

