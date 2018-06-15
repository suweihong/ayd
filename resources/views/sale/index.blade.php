@extends('layouts.layout')

@section('title','商家管理')

@section('content')

	<div class="con_right storesale">
		@include('_messages')
		@include('_delete')
		@include('store._first',['shadow'=>2,'store_id'=>$store->id])
		@include('store._third',['shadow'=>1,'store'=>$store,'sale'=>0,'type_id'=>$type_id])
		<div class="storesale_place">
			@foreach($places as $place)
			<a href="javascript:;" onclick="btnClick({{$place->id}})" id="{{$place->id}}"><span class="masked">删除</span>场地{{$loop->iteration}}{{$place->id}}</a>
			@endforeach
			<form action="{{route('fields.store')}}" method="post" name="form">
				<input type="hidden" name="_token" value=" {{ csrf_token() }}" />
				<input type="hidden" name="store_id" value="{{$store->id}}"/>
				<input type="hidden" name="type_id" value="{{$type_id}}"/>
				<a href='javascript:document.form.submit();' class="storemenu2_add">新增</a>
			</form>
		</div>
		<form name="form1" action="{{route('items.index')}}" method="get">
			<div id="storeTime">
			<input type="hidden" name="type_id" value="{{$type_id}}"></input>
			营业时间:
				<input type="time" class="start_time" name="start_time" value="{{ old('start_time',$hours[0]) }}">
				至
				<input type="time" class="end_time" name="end_time"  value="{{ old('end_time',$hours[1]) }}">
			</div>
			<a href="javascript:document.form1.submit();" class="updata_salenum">更新销售数据{{$type_id}}</a>
		</form>
		
	</div>

	<script type="text/javascript">
	//删除场地
		$('.message_del').click(function(){
			$('.del_prompt').css('display','none') ;
			$.ajax({
				url : '/fields/'+$('.message_del').attr('data_id'),
				type: 'DELETE',
				data: {
					'_token':'{{csrf_token()}}',
				},
				success : function(data){
					$('#'+$('.message_del').attr('data_id')).remove()
				}
			})
		})

	</script>
@stop