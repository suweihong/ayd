
@if($switch == 0)
	<div class="tab_data">
		<a href="{{route('fields.create')}}" class="data_week active">按星期</a>
		<a href="javascript:;" class="data_dtta">
			按日期
			<input type="text" readonly class="demo-input btn_date" id="test1"  value="2018-01-01">
			<input type="hidden" value="{{$type_id}}"></input>
		</a>
	</div>
@else
	<div class="tab_data">
		<a href="{{route('fields.show',1)}}" class="data_week active">按星期</a>
		<form action="/switch/date" method="get" name="form1" style="display: initial">
			<a href="javascript:document.form1.submit();" class="data_dtta">
				按日期
				<input type="text" readonly="readonly" class="demo-input btn_date" id="test1" name="date" value="2018-01-01">
				<input type="hidden" name="type_id" value="{{$type_id}}"></input>
			</a>
		</form>
	</div>
@endif

