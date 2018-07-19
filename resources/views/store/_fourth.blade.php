
@if($switch == 0)
	<div class="tab_data">
		<a href="{{route('fields.create')}}?store_id={{$store_id}}" @if($date==2) class="data_week active" @else class="data_week" @endif>按星期</a>
		<a href="javascript:;" @if($date==1) class="data_dtta active" @else class="data_dtta" @endif>
			按日期
			<input type="text" readonly="readonly" @if($date==1) class="demo-input btn_date active" @else class="demo-input btn_date" @endif id="test1"  value="{{$now}}">
		</a>
	</div>
@else
	<div class="tab_data">
		<a href="{{route('fields.show',1)}}?store_id={{$store_id}}" @if($date==2) class="data_week active" @else class="data_week" @endif>按星期</a>
		<a href="javascript:;" @if($date==1) class="data_dtta active" @else class="data_dtta" @endif>
			按日期
			<input type="text" readonly="readonly" @if($date==1) class="demo-input btn_date active" @else class="demo-input btn_date" @endif class="demo-input btn_date" id="test2" name="date" value="{{$now}}">
		</a>
	</div>
@endif

<script type="text/javascript">
	laydate.render({
		elem: '#test1',
		done: function(datas){ //选择日期完毕的回调
			window.location.href="/price/date?date="+datas+'&type_id={{$type_id}}&store_id={{$store->id}}';
			sessionStorage.setItem("data",datas);
	    }
	});
	laydate.render({
		elem: '#test2',
		done: function(datas){ //选择日期完毕的回调
			window.location.href="/switch/date?date="+datas+'&type_id={{$type_id}}&store_id={{$store->id}}';
			sessionStorage.setItem("data",datas);
	    }
	});
</script>

