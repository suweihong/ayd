@extends('store._second')
	@section('main')
	<!-- <h1>员工管理</h1> -->
	<div class="row">
		<div class="col-xs-12 in_box">
			<div class="col-xs-4">			
				<img class="statf_pic" src="img/pic.jpg" width="80%">
			</div>
			<div class="col-xs-4">			
				<img class="statf_pic" src="img/pic.jpg" width="80%">
			</div>
			<div class="col-xs-4">				
				<img class="statf_pic" src="img/pic.jpg" width="80%">
			</div>
			<div class="col-xs-4">				
				<img class="statf_pic" src="img/pic.jpg" width="80%">
			</div>
			<div class="col-xs-4">				
				<img class="statf_pic" src="img/pic.jpg" width="80%">
			</div>
		</div>
		<button class="btn btn-info" id="stuffAdd" style="margin:66px;">新增员工</button>
		<div class="modell col-xs-6" id="model">
			<img src="img/erweima.jpg">
			<label class="col-xs-12">请使用微信扫描以上二维码完成绑定</label>
			<button class="btn btn-info"  id="modelBtn">关闭</button>
		</div>
	</div>
@stop