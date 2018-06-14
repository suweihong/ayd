
@if($switch == 0)
	<div class="tab_data">
		<a href="{{route('fields.create')}}" @if($date==2)class="data_week active" @else class="data_week" @endif>按星期</a>
		<a href="javascript:;" @if($date==1) class="data_dtta active" @else class="data_dtta" @endif>
			按日期
			<input type="text" readonly="readonly" @if($date==1) class="demo-input btn_date active" @else class="demo-input btn_date" @endif id="test1"  value="{{$now}}">
		</a>
	</div>
@else
	<div class="tab_data">
		<a href="{{route('fields.show',1)}}" @if($date==2)class="data_week active" @else class="data_week" @endif>按星期</a>
		<a href="javascript:;" @if($date==1) class="data_dtta active" @else class="data_dtta" @endif>
			按日期
			<input type="text" readonly="readonly" @if($date==1) class="demo-input btn_date active" @else class="demo-input btn_date" @endif class="demo-input btn_date" id="test1" name="date" value="{{$now}}">
		</a>
	</div>
@endif

