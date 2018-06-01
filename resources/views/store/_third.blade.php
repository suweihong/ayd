
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-pills"  id="store_menu2">
				@if($types)
					@if($sale == 0)
						@foreach ($types as $type)
							<li  @if($type_id == $type->id) class="btn  active" @else class="btn" @endif><a href="{{route('fields.index')}}?type_id={{$type->id}}">{{$type->name}}</a></li>					
						@endforeach
					@elseif($sale == 1)
						@foreach ($types as $type)
							<li  @if($type_id == $type->id) class="btn  active" @else class="btn" @endif><a href="{{route('fields.create')}}?type_id={{$type->id}}">{{$type->name}}</a></li>					
						@endforeach
					@elseif($sale == 2)
						@foreach ($types as $type)
							<li  @if($type_id == $type->id) class="btn  active" @else class="btn" @endif><a href="/price/date?type_id={{$type->id}}">{{$type->name}}</a></li>					
						@endforeach
					@elseif($sale == 3)
						@foreach ($types as $type)
							<li  @if($type_id == $type->id) class="btn  active" @else class="btn" @endif><a href="{{route('fields.show',1)}}?type_id={{$type->id}}">{{$type->name}}</a></li>					
						@endforeach
					@elseif($sale == 4)
						@foreach ($types as $type)
							<li  @if($type_id == $type->id) class="btn  active" @else class="btn" @endif><a href="/switch/date?type_id={{$type->id}}">{{$type->name}}</a></li>					
						@endforeach
					@elseif($sale == 5)
						@foreach ($types as $type)
							<li  @if($type_id == $type->id) class="btn  active" @else class="btn" @endif><a href="/tickets/list?type_id={{$type->id}}&&item_id=2">{{$type->name}}</a></li>					
						@endforeach
					@endif
				@endif
					<li class="btn_add"><a href="{{route('items.create')}}?store_id={{$store->id}}">新增</a></li>
			</ul>
		</div>
		<div class="col-xs-12">
			<ul id="store_menu1" class="col-xs-12">
				<li @if($shadow == 1) class="active" @endif><a href="{{route('fields.index')}}?item_id=1">场地配置</a></li>
				<li @if($shadow == 2) class="active" @endif><a href="{{route('fields.create')}}?item_id=1">价格配置</a></li>
				<li @if($shadow == 3) class="active" @endif><a href="{{route('fields.show',$store->id)}}?item_id=1">场地管理</a></li>
				<li @if($shadow == 4) class="active" @endif><a href="/tickets/list?item_id=2">票卡管理</a></li>
			</ul>
		</div>
	</div>


