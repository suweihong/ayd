@extends('store._fourth')
	@section('part')
	<!-- <h1>按日期</h1> -->
	<div class="tab-pane fade in active saletab" id="saletab1">
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