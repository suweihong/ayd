@extends('store._third')
	@section('subject')
	<!-- <h1>场地价格</h1> -->
		<ul class="nav nav-pills" id="store_menu2">
			<li class="active btn"><a href="#saletab1" data-toggle="tab" class="btnt">按星期</a></li>
			<li class="btn"><a href="#saletab2" data-toggle="tab" class="btnt">按日期</a></li>
		</ul>
		<div class="tab-pane fade in active saletab" id="saletab1">
			<ul class="nav nav-pills">
				<li class="active btn btnt btnt0" data-toggle="tab"><a>星期一</a></li>
				<li class="btn btnt" data-toggle="tab"><a>星期二</a></li>
				<li class="btn btnt" data-toggle="tab"><a>星期三</a></li>
				<li class="btn btnt" data-toggle="tab"><a>星期四</a></li>
				<li class="btn btnt" data-toggle="tab"><a>星期五</a></li>
				<li class="btn btnt" data-toggle="tab"><a>星期六</a></li>
				<li class="btn btnt" data-toggle="tab"><a>星期日</a></li>
			</ul>
			<table class="col-sm-12">
				<tr>
					<th class="btn"></th>
					<th class="btn btn-info">场地一</th>
					<th class="btn btn-info">场地二</th>
					<th class="btn btn-info">场地三</th>
					<th class="btn btn-info">场地四</th>
					<th class="btn btn-info">场地五</th>
				</tr>
				<tr>
					<td class="btn btn-info">08-09</td>
					<td class="btn btn-btn">212</td>
					<td class="btn btn-btn">212</td>
					<td class="btn btn-btn">212</td>
					<td class="btn btn-btn">212</td>
					<td class="btn btn-btn">212</td>
				</tr>
				<tr>
					<td class="btn btn-info">09-10</td>
					<td class="btn btn-btn">212</td>
					<td class="btn btn-btn">212</td>
					<td class="btn btn-btn">212</td>
					<td class="btn btn-btn">212</td>
					<td class="btn btn-btn">212</td>
				</tr>
			</table>
			<div class="btn btn-info" style="margin:20px 40px">更新销售数据</div>
		</div>
@stop