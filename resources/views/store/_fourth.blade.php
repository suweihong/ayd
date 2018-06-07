
@if($switch == 0)
		<!-- 价格 -->
	<ul class="nav nav-pills" id="store_menu2">
		<li class="active btn"><a href="{{route('fields.create')}}" class="btnt">按星期</a></li>
		<li class="btn">
<<<<<<< HEAD
		<a href="/price/date" class="btnt" style="position: absolute;z-index: 9">按日期</a>

			
				<input type="text" class="demo-input" id="test1" value="{{$now}}">
=======

			<!-- <a href="/price/date" class="btnt" style="position: absolute;z-index: 9">按日期</a> -->
<form action="/price/date" method="get" name="form">
		<a href="javascript:document.form.submit();" class="btnt btn_date  price_date" style="position: absolute;z-index: 9">按日期</a>
		<input type="text" class="demo-input btn_date" id="test1" name="date" value="">
		<input type="hidden" name="type_id" value="{{$type_id}}"></input>
</form>


>>>>>>> 7b9a85691e0232d70d677e0627d98d3e87bc2e11

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
<<<<<<< HEAD
	laydate.render({
		elem: '#test1',
		done: function(value, date, endDate){
	    	console.log(value); //2017-08-18
	    	console.log(date); //{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
		}
	});
</script>
=======
$('.btn_date').click(function(){
	console.log($('#test1').val())
});
	laydate.render({
			elem: '#test1',
		});

</script>
>>>>>>> 7b9a85691e0232d70d677e0627d98d3e87bc2e11
