<div class="storemenu1">
	<a href="{{route('stores.edit',$store_id)}}"@if($shadow == 1) class="active" @endif>基础信息管理</a>
	<a href="{{route('mpusers.create')}}?store_id={{$store_id}}" @if($shadow == 2) class="active" @endif>管理员设置</a>
	<a href="{{route('staffs.index')}}?store_id={{$store_id}}" @if($shadow == 3) class="active" @endif>员工管理</a>
</div>
