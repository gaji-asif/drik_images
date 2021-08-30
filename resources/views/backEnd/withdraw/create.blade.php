@extends('backEnd.master')
@section('mainContent')
<div class="row">
	@if(session()->has('message-success'))
		<div class="alert alert-success mb-3 background-success" role="alert">
			{{ session()->get('message-success') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@elseif(session()->has('message-danger'))
		<div class="alert alert-danger">
			{{ session()->get('message-danger') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif

	<div class="col-md-12">
		
		<div id="inner_div">
			@include('backEnd.withdraw.inner_div')
		</div>

	</div>
</div>

<script>
// $(document).ready(function() {
// 	$('#action-icon').data();
// });
</script>
@endSection