

	<div class="row">
		<div class="col-xs-12 in_box">
			<ul id="store_menu1" class="col-xs-12">
				<li @if($shadow == 1) class="active" @endif><a href="{{route('stores.edit',$store_id)}}">基础信息管理</a></li>
				<li @if($shadow == 2) class="active" @endif><a href="{{route('mpusers.create')}}">管理员设置</a></li>
				<li @if($shadow == 3) class="active" @endif><a href="{{route('staffs.index')}}">员工管理</a></li>
			</ul>
		</div>
	</div>
