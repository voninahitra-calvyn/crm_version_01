<!-- Compiled app javascript -->
<script src="{{ url (mix('/js/app.js')) }}"></script>
	<script src="{{ asset ('/js/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset ('/js/select2.full.js') }}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.selecttype').select2()

  })
</script>