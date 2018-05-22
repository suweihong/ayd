@extends('layouts.layout')

@section('title','奥运动管理系统')

@section('content')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"></li>
				<li class="active"></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
{{-- 			<div class="col-lg-12">
				<h1 class="page-header">Alerts &amp; Panels</h1>
			</div>
 --}}		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<h2>今日订单预览</h2>
	
				<div class="col-xs-12 col-md-6 col-lg-3">
					<div class="panel panel-blue panel-widget ">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large">120</div>
								<div class="text-muted">下单数</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">52</div>
							<div class="text-muted">核销数</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">24</div>
							<div class="text-muted">退单数</div>
						</div>
					</div>
				</div>
			</div>
			
			</div>
		</div><!--/.row-->		
		
		
		<div class="row">
			<div class="col-lg-12">
				<h2>财务概况  <a href="">今日</a>  <a href="">昨日</a>  <a href="">本月</a></h2>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Default Panel
					</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
					</div>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Primary Panel
					</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
					</div>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="panel panel-success">
					<div class="panel-heading">
						Success Panel
					</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
					</div>
				</div>
			</div>
			
		</div><!-- /.row -->
			
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						Info Panel
					</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-warning">
					<div class="panel-heading">
						Warning Panel
					</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-danger">
					<div class="panel-heading">
						Danger Panel
					</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
					</div>
				</div>
			</div>
			
		</div><!-- /.row -->
		
		
		
		
		<div class="row">
			<div class="col-lg-12">
				<h2>消息动态</h2>
			</div>
			
			<div class="col-md-6">
				<div class="panel panel-blue">
					<div class="panel-heading dark-overlay">Blue Panel</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
					</div>
				</div>
			</div><!--/.col-->
			
			<div class="col-md-6">
				<div class="panel panel-teal">
					<div class="panel-heading dark-overlay">Teal Panel</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
					</div>
				</div>
			</div><!--/.col-->
			
			<div class="col-md-6">
				<div class="panel panel-orange">
					<div class="panel-heading dark-overlay">Orange Panel</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
					</div>
				</div>
			</div><!--/.col-->
			
			<div class="col-md-6">
				<div class="panel panel-red">
					<div class="panel-heading dark-overlay">Red Panel</div>
					<div class="panel-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ut ante in sapien blandit luctus sed ut lacus. Phasellus urna est, faucibus nec ultrices placerat, feugiat et ligula. Donec vestibulum magna a dui pharetra molestie. Fusce et dui urna.</p>
					</div>
				</div>
			</div><!--/.col-->
		</div><!--/.row-->	
@stop