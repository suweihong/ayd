
<div id="error_messages" >
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(session()->has($msg))
    <div class="flash-message">
      <p class="alert alert-{{ $msg }}">
        {{ session()->get($msg) }}
      </p>
    </div>
  @endif
@endforeach

<script type="text/javascript">
					setTimeout(() => {
						$("#error_messages").slideUp()
					}, 3000)
				</script>

</div>
<!-- <link href="css/admin/bootstrap.min.css" rel="stylesheet">
<link href="css/admin/datepicker3.css" rel="stylesheet">
<link href="css/admin/styles.css" rel="stylesheet">
<script src="js/admin/lumino.glyphs.js"></script>


@if ($errors)

<div class="alert bg-warning" role="alert">
					<svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg> {{$errors}} <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
				</div>
@endif
 -->

<!-- <script src="js/admin/jquery-1.11.1.min.js"></script> -->
	<!-- <script src="js/admin/bootstrap.min.js"></script> -->
	<!-- <script src="js/admin/chart.min.js"></script> -->
	<!-- <script src="js/admin/chart-data.js"></script> -->
	<!-- <script src="js/admin/easypiechart.js"></script> -->
	<!-- <script src="js/admin/easypiechart-data.js"></script> -->
	<!-- <script src="js/admin/bootstrap-datepicker.js"></script> -->
	 <!--<script>
		// !function ($) {
			// $(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				// $(this).find('em:first').toggleClass("glyphicon-minus");	  
			// }); 
			// $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		// }(window.jQuery);

		// $(window).on('resize', function () {
		  // if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		// })
		// $(window).on('resize', function () {
		  // if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		// })
	// </script>	