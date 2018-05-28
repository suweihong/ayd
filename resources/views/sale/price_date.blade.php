@extends('store._third')
	@section('subject')
	<!-- <h1>场地价格</h1> -->
		<ul class="nav nav-pills" id="store_menu2">
			<li class="active btn"><a href="#saletab1" data-toggle="tab" class="btnt">按星期</a></li>
			<li class="btn"><a href="#saletab2" data-toggle="tab" class="btnt">按日期</a></li>
		</ul>
		<div class="tab-pane fade in active saletab" id="saletab1">
			按日期
			<div class="btn btn-info" style="margin:20px 40px">更新销售数据</div>
		</div>
		<div class="tab-pane fade saletab" id="saletab2">
			爱上这个法师的公司的
		</div>
@stop