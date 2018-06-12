
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

