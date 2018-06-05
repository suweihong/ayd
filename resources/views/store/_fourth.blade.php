
@if($switch == 0)
	<ul class="nav nav-pills" id="store_menu2">
		<li class="active btn"><a href="{{route('fields.create')}}" class="btnt">按星期</a></li>
		<li class="btn">
	<!-- 	<a href="/price/date" class="btnt" style="position: absolute;z-index: 9">按日期</a> -->

			<a href="javascript:void(0);" class="btnt btn_date" style="position: absolute;z-index: 9">按日期11</a>
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
	laydate.render({
			elem: '#test1',
			done: function(value, date, endDate){
		    	console.log(value); //2017-08-18
		    	console.log(date); //{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
		    	$(".btn_date").unbind("click");
		    	$('.btn_date').click(function(){
				$.ajax({
					url : '/price/date',
					type : 'get',
					data : {
						'date' : value,
					},

				})
			})
			},
		});

</script>