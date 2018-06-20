<h1 class="in_title">商家管理</h1>
<div class="storemenu1">
	<a href="{{route('stores.edit',$store_id)}}"  @if($shadow == 1) class="active" @endif>基础信息</a>
	<a href="{{route('fields.index')}}" @if($shadow == 2) class="active" @endif>销售</a>
	<a href="/store/orders?store_id={{$store_id}}" @if($shadow == 3) class="active" @endif>订单</a>
	<a href="{{route('estimates.index')}}" @if($shadow == 4) class="active" @endif>评价</a>
</div>

