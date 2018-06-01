@extends('layouts.layout')

@section('title','场地管理')

@section('content')

	@include('store._first',['shadow'=>2,'store_id'=>$store->id])
	@include('store._third',['shadow'=>4,'store'=>$store,'sale'=>5,'type_id'=>$type_id])
	

<h1>票卡类</h1>

@stop