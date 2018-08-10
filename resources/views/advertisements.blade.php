@extends('layouts.layout')

@section('title','奥运动管理系统')

@section('content')
<div class="con_right advertisment">
	<h1 class="in_title">广告管理</h1>
	<label class="title">主广告位</label>
	<div class="in_pry1box">
		<div class="in_pry1_item">
			<div class="pic_pic">
				<input type="file" class="addchuan file_main" id="file" style="display:none;" onchange="filechange(event)">
				<img src="img/pic.jpg"  width="100%" id="img-change" class="file_mainImg">
				<!-- <input type="file" class="addchuan">
				<img src="img/pic.jpg" width="100%"> -->	
			</div>
			<input type="text" class="address" placeholder="请输入目标地址">
			<p class="btn_wh">提交修改</p>
			<p class="btn_ws">删除</p>
		</div>
		<div class="in_pry1_item">
			<div class="pic_pic">
				<input type="file" class="addchuan">
				<img src="img/pic.jpg" width="100%">	
			</div>
			<input type="text" class="address" placeholder="请输入目标地址">
			<p class="btn_wh">提交修改</p>
			<p class="btn_ws">删除</p>
		</div>
		<div class="in_pry1_item">
			<div class="pic_pic">
				<input type="file" class="addchuan">
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
							<input type="file" class="addchuan">
							<img src="img/pic.jpg" width="100%">	
						</div>
						<input type="text" class="address" placeholder="请输入目标地址">
					</div>
					<div class="in_pry1_item">
						<div class="pic_pic">
							<input type="file" class="addchuan">
							<img src="img/pic.jpg" width="100%">	
						</div>
						<input type="text" class="address" placeholder="请输入目标地址">
					</div>
				</div>
				</br>
				<div class="slowlists2">
					<div class="in_pry1_item">
						<div class="pic_pic">
							<input type="file" class="addchuan">
							<img src="img/pic.jpg" width="100%">	
						</div>
						<input type="text" class="address" placeholder="请输入目标地址">
					</div>
					<div class="in_pry1_item">
						<div class="pic_pic">
							<input type="file" class="addchuan">
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
<div class="maskCutting" style="width: 100%;height: 100%;position: absolute;z-index: 1;display: none;">
	
</div>
<script>
	$(".file_mainImg").click(function () {
		$(this).siblings('.file_main').click();
	})
  /*$("#file").change(function (event) {*/
	var filechange=function(event){
	    var files = event.target.files, file;
	    if (files && files.length > 0) {
	        // 获取目前上传的文件
	        file = files[0];// 文件大小校验的动作
	        if(file.size > 1024 * 1024 * 2) {
	            alert('图片大小不能超过 2MB!');
	            return false;
	        }
	        // 获取 window 的 URL 工具
	        var URL = window.URL || window.webkitURL;
	        // 通过 file 生成目标 url
	        var imgURL = URL.createObjectURL(file);
	        //用attr将img的src属性改成获得的url
	        $("#img-change").attr("src",imgURL);
	        // 使用下面这句可以在内存中释放对此 url 的伺服，跑了之后那个 URL 就无效了
	        // URL.revokeObjectURL(imgURL);
	        $.ajaxFileUpload({
	            url: '/imgUpload',
	            fileElementId:'file',
	            dataType:'txt',
	            secureuri : false,
	            success: function (data){
	            	alert(data)
	                // if(data=="yes"){
	                //     $("#img-alert").css("display","block");
	                // }
	            },
	            error:function(data,status,e){
	                alert(1);
	            }
	        });
	    }
	};
</script>

@endsection