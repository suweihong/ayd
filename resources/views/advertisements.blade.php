

@extends('layouts.layout')

@section('title','奥运动管理系统')

@section('content')
<div class="con_right advertisment">
	<h1 class="in_title">消息动态</h1>
	<label class="title">主广告位</label>
	<div class="in_pry1box">
		<div class="in_pry1_item">
			<div class="pic_pic">
				<img src="img/pic.jpg" width="100%">	
			</div>
			<input type="text" class="address" placeholder="请输入目标地址">
			<p class="btn_wh">提交修改</p>
			<p class="btn_ws">删除</p>
		</div>
		<div class="in_pry1_item">
			<div class="pic_pic">
				<img src="img/pic.jpg" width="100%">	
			</div>
			<input type="text" class="address" placeholder="请输入目标地址">
			<p class="btn_wh">提交修改</p>
			<p class="btn_ws">删除</p>
		</div>
		<div class="in_pry1_item">
			<div class="pic_pic">
				<img src="img/pic.jpg" width="100%">	
			</div>
			<input type="text" class="address" placeholder="请输入目标地址">
			<p class="btn_wh">提交修改</p>
			<p class="btn_ws">删除</p>
		</div>
	</div>
	<label class="title">次广告位</label>
	<div class="in_pry2box">
		<ul class="in_pry2box_tab">
			<li class="in_pry2box_tab_1 in_pry2box_tabb" onclick="tabs(1)">2x2栏</li>
			<li class="in_pry2box_tab_0 in_pry2box_tabb" onclick="tabs(2)">单栏</li>
		</ul>
		<div class="in_pry2box_content">
			<div class="in_pry2box_content_show1">
				<div class="slowlists1">
					<div class="in_pry1_item">
						<div class="pic_pic">
							<img src="img/pic.jpg" width="100%">	
						</div>
						<input type="text" class="address" placeholder="请输入目标地址">
					</div>
					<div class="in_pry1_item">
						<div class="pic_pic">
							<img src="img/pic.jpg" width="100%">	
						</div>
						<input type="text" class="address" placeholder="请输入目标地址">
					</div>
				</div>
				</br>
				<div class="slowlists2">
					<div class="in_pry1_item">
						<div class="pic_pic">
							<img src="img/pic.jpg" width="100%">	
						</div>
						<input type="text" class="address" placeholder="请输入目标地址">
					</div>
					<div class="in_pry1_item">
						<div class="pic_pic">
							<img src="img/pic.jpg" width="100%">	
						</div>
						<input type="text" class="address" placeholder="请输入目标地址">
					</div>
				</div>
			</div>
			<div class="in_pry2box_content_show2">
				<div class="in_pry1_item">
					<div class="pic_pic_big">
						<img src="img/pic.jpg" width="100%">	
					</div>
					<input type="text" class="address_big" placeholder="请输入目标地址">
				</div>
			</div>
		</div>
		<div class="in_pry1_submit">提交修改</div>
	</div>
</div>


@endsection