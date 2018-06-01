@extends('layouts.layout')

@section('title','商家管理')

@section('content')
	<!-- <h1>管理员设置</h1> -->
	<div id="errors_messages" style="display: none">						 
			   <div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"></svg>请先设置管理员账号</span></a>
				</div>
			
		<script type="text/javascript">
					setTimeout(() => {
						$("#errors_messages").slideUp()
					}, 3000)
				</script>

	</div>

	@include('_messages')
	@include('store._first',['shadow'=>1,'store_id'=>$store->id])
	@include('store._second',['shadow'=>2,'store_id'=>$store->id ])

	

	<div class="row">

		<div class="col-xs-12 in_box">
			
			<div class="col-xs-12">
				<form method="post" action="{{route('mpusers.store')}}">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="store_id" value="{{$store->id}}">
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="col-xs-1">账号{{$store->id}}</span>
						@if($store->mp_user)
							<input type="text" class="form-control col-xs-6" placeholder="" name="account" value="{{ old('account',$store->mp_user->account) }}" />
						@else	
							<input type="text" class="form-control col-xs-6" placeholder="请设置账号" name="account" value="{{ old('account') }}" />
						@endif	
					</label> 
					<label class="form-inline col-xs-12 form-inline-g">
						<span class="col-xs-1">密码 </span>
						<input type="password" class="form-control col-xs-6" placeholder="" name="password"  value="{{ old('password') }}" />
						

					</label>  
					<button class="btn btn-info" style="margin: 70px">　保存　</button>
				</form>

			
						@if($store->mp_user)
							<form action="{{ route('mpusers.update',$store->mp_user->id) }}" method="post" name="form1">
								<input type="hidden" name= '_token' value="{{ csrf_token() }}" />
								<input type="hidden" name="_method" value="PATCH">
								<a href='javascript:document.form1.submit();' style="color: #428bca;position: absolute;top: 78px;left: 526px;" >重置为: 123456</a>
							</form>							
						@else
							<a href='javascript:void(0);' style="margin:10px;margin-bottom:450px;color: #428bca" class="reset_password">重置为: 123456</a>
						@endif
				
			</div>
			
		
		</div>
	</div>

	<script type="text/javascript">

		$('.reset_password').click(function(){
			$("#errors_messages").show()
		})
		
	</script>
@stop