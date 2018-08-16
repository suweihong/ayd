
@extends('layouts.layout')

@section('title','场地管理')

@section('content')
	
<div class="con_right storesale">
	@include('_messages')
	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>2,'store'=>$store,'sale'=>2,'type_id'=>$type_id])
	@include('store._fourth',['shadow'=>1,'store_id'=>$store->id,'switch'=>0,'now'=>$now,'type_id=>$type_id','date'=>1,'store_id'=>$store->id])
	
	<table class="table_btn">
		<tr>
			<th class="none"></th>
			@foreach ($prices as $key => $price)
				@if($key == $start_time)
					@foreach($price as $v)
							<th>场地{{$loop->iteration}}{{$v->place_id}}</th>
					@endforeach
				@endif
			@endforeach
		</tr>
		@foreach ($prices as $key => $price)
			<tr>
				<td>{{$key}}:00-{{$key+1}}:00</td>
				@foreach($price as $value)
				<td>
					<input type="text" onchange="datePrice({{$value->id}})" id="{{$value->id}}" value="{{$value->price}}" maxlength="8" class="table_btn_num"/>
				</td>
				@endforeach
			</tr>
		@endforeach
	</table>
	<a href="javascript:;" class="updata_salenum" onclick="price()">更新销售数据</a>
</div>
<script type="text/javascript">
	if(sessionStorage.getItem("data")!=null){
		$('#test1').val(sessionStorage.getItem("data"))
	}
	//修改价格
	arr=[]
	function datePrice(id){
		arr.push({'id':id,'price':$('#'+id).val()})
	}
	function price(){
		setTimeout(() => {
	  		$("#error_messages").slideUp()
	  	}, 2000)
		$.ajax({
			url : '/price/update',
			type : 'POST',
			data : {
				'_token' : '{{csrf_token()}}',
				'arr' : arr,
				'date' : sessionStorage.getItem("data"),
				
			},
			success : function(data)
			{
				$('#error_messages').show()
				$('#error_messages .flash-message').remove()
				var tt=data.errmsg
				if(data.errcode==2){
					var classn="alert-warning"
				}else{
					var classn="alert-success"
				}
				var html='<div class="flash-message">\
					        <p class="alert '+classn+'">'+tt+'</p>\
				      	</div>'
				$('#error_messages').append(html)
			}
		})
		arr=[]
	}
</script>
@stop