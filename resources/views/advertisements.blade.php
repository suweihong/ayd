@extends('layouts.layout')

@section('title','奥运动管理系统')

@section('content')
<div class="con_right advertisment">
	<h1 class="in_title">广告管理</h1>
	<label class="title">主广告位</label>
				<div class="box" id="sssss" style="display: none;z-index: 99;">
					<img src="" id="img"  class="pic cutimgsens"/>
					<p class="l-btn sureCut" id="sureCut" style="position: absolute;z-index: 9;background-color:#2196F3;color: #fff;bottom: 20px;left: 214px;padding: 2px 10px">确定裁剪</p>
				</div>
	<div class="in_pry1box">
		<div class="in_pry1_item">
			<div class="pic_pic">
				<!-- <input type="file" class="addchuan file_main" id="file" style="display:none;" onchange="filechange(event)">
				<img src=""  width="100%" id="img-change" class="file_mainImg"> -->
				<!-- <input type="file" class="addchuan">
				<img src="img/pic.jpg" width="100%"> -->


				<input type="file" class="fileBtn addchuan pic" onchange="fileBtn(this,1)" />
				<img src="img/pic.jpg" class="pic show-pic1"  />	
			</div>
			<input type="text" class="address" placeholder="请输入目标地址">
			<p class="btn_wh">提交修改</p>
			<p class="btn_ws">删除</p>
		</div>
		<div class="in_pry1_item">
			<div class="pic_pic">
				<input type="file" class="fileBtn addchuan pic" onchange="fileBtn(this,2)" />
				<img src="img/pic.jpg" class="pic show-pic2"  />	
			</div>
			<input type="text" class="address" placeholder="请输入目标地址">
			<p class="btn_wh">提交修改</p>
			<p class="btn_ws">删除</p>
		</div>
		<div class="in_pry1_item">
			<div class="pic_pic">
				<input type="file" class="fileBtn addchuan pic" onchange="fileBtn(this,3)" />
				<img src="img/pic.jpg" class="pic show-pic3"  />	
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
<script>
	// $(".file_mainImg").click(function () {
	// 	$(this).siblings('.file_main').click();
	// })
  /*$("#file").change(function (event) {*/
	// var filechange=function(event){
	//     var files = event.target.files, file;
	//     if (files && files.length > 0) {
	//         // 获取目前上传的文件
	//         file = files[0];// 文件大小校验的动作
	//         if(file.size > 1024 * 1024 * 2) {
	//             alert('图片大小不能超过 2MB!');
	//             return false;
	//         }
	//         // 获取 window 的 URL 工具
	//         var URL = window.URL || window.webkitURL;
	//         // 通过 file 生成目标 url
	//         var imgURL = URL.createObjectURL(file);
	//         //用attr将img的src属性改成获得的url
	//         $("#img-change").attr("src",imgURL);
	//         // 使用下面这句可以在内存中释放对此 url 的伺服，跑了之后那个 URL 就无效了
	//         // URL.revokeObjectURL(imgURL);
	//         $.ajaxFileUpload({
	//             url: '/imgUpload',
	//             fileElementId:'file',
	//             dataType:'txt',
	//             secureuri : false,
	//             success: function (data){
	//             	alert(data)
	//                 // if(data=="yes"){
	//                 //     $("#img-alert").css("display","block");
	//                 // }
	//             },
	//             error:function(data,status,e){
	//                 alert(1);
	//             }
	//         });
	//     }
	// };
	function fileBtn(obj,e){
		if ($('.'+'fileBtn'+e).val()=='') {return;}
		lrz(obj.files[0],{width:600,quality:1})
        .then(function (rst) {
	        // console.log(rst)
	        // var myImage=rst.base64
	        $('.cutimgsens').cropper({
	        	background:false,
	        	aspectRatio: 100/57,
	        	viewMode:1,
	            crop: function(data) {

	            }
	        });

	    	$('.sureCut,.box').fadeIn(300,function(){
	            $('.cutimgsens').cropper('setCropBoxData', {});
	        });


	        // 缩放图片更改
	        $('.cutimgsens').cropper('reset',true).cropper('replace', rst.base64)
	        $(".sureCut").on("click", function() {  
				var cas=$('.cutimgsens').cropper("getCroppedCanvas")// 获取被裁剪后的canvas  
			    var base64 = cas.toDataURL(); // 转换为base64   
			    alert(base64)
			    $('.'+'show-pic'+e).each(function(){
			    	$(this).attr('src',base64).show()
			    })
			   	// $('.'+'show-pic'+e).attr('src',base64).show() 
	            $('#sssss').hide()
			    // $.ajax({
			    // 	url: '***',
			    // 	type: 'POST',
			    // 	dataType: 'json',
			    // 	data: {img_64: base64},
			    // })
			    // .done(function(json) {
			    	
			    // })
			    // .fail(function() {
			    // 	console.log("error");
			    // })
			    // .always(function() {
			    // 	console.log("complete");
			    // });
			}); 
	    })
	 }
</script>

@endsection