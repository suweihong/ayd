@extends('layouts.layout')

@section('title','奥运动管理系统')

@section('content')
<div class="row">
	<div class="col-md-12 in_box">
		<div class="alert" role="alert">
			<span class="in_title">广告管理</span>
		</div>
		<label class="title">主广告位</label>
		<div class="col-md-4 in_pry1_item">
			<div class="pic_pic">
				<img src="img/pic.jpg" width="100%">	
			</div>
			<input type="text" class="address" placeholder="请输入目标地址">
			<button class="btn btn-info btn_wh">提交修改</button>
			<button class="btn btn-danger btn_wh">删除</button>
		</div>
		<div class="col-md-4 in_pry1_item">
			<div class="pic_pic">
				<img src="img/pic.jpg" width="100%">	
			</div>
			<input type="text" class="address" placeholder="请输入目标地址">
			<button class="btn btn-info btn_wh">提交修改</button>
			<button class="btn btn-danger btn_wh">删除</button>
		</div>
		<div class="col-md-4 in_pry1_item">
			<div class="pic_pic">
				<img src="img/pic.jpg" width="100%">	
			</div>
			<input type="text" class="address" placeholder="请输入目标地址">
			<button class="btn btn-info btn_wh">提交修改</button>
			<button class="btn btn-danger btn_wh">删除</button>
		</div>
	</div>
	<div class="col-md-12 in_box">
		<label class="title">次广告位</label>
		<div class="col-md-12">
			<div class="panel-default">
				<div class="panel-body tabs">
					<ul class="nav nav-pills">
						<li class="active"><a href="#pilltab1" data-toggle="tab">2x2栏</a></li>
						<li><a href="#pilltab2" data-toggle="tab">单栏</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade in active" id="pilltab1">
							<div class="show1">
								<div class="col-md-6 in_pry1_item">
									<div class="pic_pic">
										<img src="img/pic.jpg" width="100%">	
									</div>
									<input type="text" class="address" placeholder="请输入目标地址">
								</div>
								<div class="col-md-6 in_pry1_item">
									<div class="pic_pic">
										<img src="img/pic.jpg" width="100%">	
									</div>
									<input type="text" class="address" placeholder="请输入目标地址">
								</div>
								<div class="col-md-6 in_pry1_item">
									<div class="pic_pic">
										<img src="img/pic.jpg" width="100%">	
									</div>
									<input type="text" class="address" placeholder="请输入目标地址">
								</div>
								<div class="col-md-6 in_pry1_item">
									<div class="pic_pic">
										<img src="img/pic.jpg" width="100%">	
									</div>
									<input type="text" class="address" placeholder="请输入目标地址">
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="pilltab2">
							<div class="show2">
								<div class="col-md-12 in_pry1_item">
									<div class="pic_pic_big">
										<img src="img/pic.jpg" width="100%">	
									</div>
									<input type="text" class="address_big" placeholder="请输入目标地址">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 in_pry1_item">
						<button class="btn btn-info btn_wh_big">提交修改</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection