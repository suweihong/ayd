
@extends('store._second')
	@section('main')
	<!-- <h1>基础信息管理页</h1> -->

	<div class="row">
		<div class="col-xs-12 in_box">
			<div class="col-xs-12">
				<label class="form-inline col-xs-12 form-inline-g">
					<span class="col-xs-1">名称 </span>
					<input type="text" class="form-control col-xs-6" placeholder="澳方体育馆"/>
				</label> 
				<label class="form-inline col-xs-12 form-inline-g">
					<span  class="col-xs-1">商家位置 </span>
					<div class="form-group">
						<select class="form-control">
						    <option>吉林省</option>
						    <option>吉林省</option>
						</select>  
					</div>
					<div class="form-group">
						<select class="form-control">
						    <option>长春市</option>
						    <option>长春市</option>
						</select>  
					</div>
					<div class="form-group">
						<select class="form-control">
						    <option>净月区</option>
						    <option>净月区</option>
						</select>  
					</div>
					<br>
					<input type="text" class="form-control form-control_ipt" placeholder="如xx街道xx号"/>
					<br>
					<input type="text" class="form-control form-control_ipt" placeholder="地图名片地址"/>
					<br>
				</label> 

				<label class="form-inline col-xs-12 form-inline-g">
					<span class="col-xs-1">场馆封面图 </span>
					<div class="pic_pic col-xs-3" >
						<img src="../../img/pic.jpg" width="100%">	
					</div>
				</label> 
				<label class="form-inline col-xs-12 form-inline-g">
					<span class="col-xs-1">场馆实拍 </span>
					<div class="pic_pic col-xs-3" >
						<img src="../../img/pic.jpg" width="100%">	
					</div>
					<div class="pic_pic col-xs-3" >
						<img src="../../img/pic.jpg" width="100%">	
					</div>
					<div class="pic_pic col-xs-3" >
						<img src="../../img/pic.jpg" width="100%">	
					</div>
				</label> 
				<label class="form-inline col-xs-12 form-inline-g">
					<span class="col-xs-1">联系电话 </span>
					<input type="text" class="form-control" placeholder="按名称检索"/>
				</label>
				<label class="form-inline col-xs-12 form-inline-g">
					<span class="form-inline-g-ap col-xs-1">场馆简介 </span>
					 <textarea rows="3" cols="20" class="form-control" placeholder="场馆简介"> </textarea>
				</label>  
				<a href="{{ route('stores.index')}}" class="btn btn-info">更新场地信息</a>
				<a href="{{ route('stores.index')}}" class="btn clickt">返回</a>
			</div>
		</div>
	</div>			
@stop
	