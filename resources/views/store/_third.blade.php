<div class="storemenu2">
	@if($types)
		@if($sale == 0)
			@foreach ($types as $type)
				<a @if($type_id == $type->id) class="active" @endif href="{{route('fields.index')}}?type_id={{$type->id}}">{{$type->name}}</a>
			@endforeach
		@elseif($sale == 1)
			@foreach ($types as $type)
				<a @if($type_id == $type->id) class="active" @endif href="{{route('fields.create')}}?type_id={{$type->id}}">{{$type->name}}</a>
			@endforeach
		@elseif($sale == 2)
			@foreach ($types as $type)
				<a @if($type_id == $type->id) class="active" @endif href="/price/date?type_id={{$type->id}}&date={{$_SESSION['date']}}">{{$type->name}}</a>
			@endforeach
		@elseif($sale == 3)
			@foreach ($types as $type)
				<a @if($type_id == $type->id) class="active" @endif href="{{route('fields.show',1)}}?type_id={{$type->id}}">{{$type->name}}</a>
			@endforeach
		@elseif($sale == 4)
			@foreach ($types as $type)
				<a @if($type_id == $type->id) class="active" @endif href="/switch/date?type_id={{$type->id}}&date={{$_SESSION['date']}}">{{$type->name}}</a>
			@endforeach
		@elseif($sale == 5)
			@foreach ($types as $type)
				<a @if($type_id == $type->id) class="active" @endif href="/tickets/list?type_id={{$type->id}}&item_id=2">{{$type->name}}</a>
			@endforeach
		@endif
	@endif
	<a href="{{route('items.create')}}?store_id={{$store->id}}" class="storemenu2_add">新增</a>
</div>
<div class="storemenu1">
	<a @if($shadow == 1) class="active" @endif href="{{route('fields.index')}}?item_id=1">场地配置</a>
	<a @if($shadow == 2) class="active" @endif href="{{route('fields.create')}}?item_id=1">价格配置</a>
	<a @if($shadow == 3) class="active" @endif href="{{route('fields.show',$store->id)}}?item_id=1">场地管理</a>
	<a @if($shadow == 4) class="active" @endif href="/tickets/list?item_id=2">票卡管理</a>
</div>


