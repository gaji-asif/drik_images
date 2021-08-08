@extends('backEnd.master')
@section('mainContent')
<style type="text/css">
	.card-block{
		margin: 0 auto;
	}
</style>
<div class="row">
	<div class="col-xl-3 col-md-6">
		<div class="card">
			<div class="card-block" style="padding: 32px; text-align: center;">
				<a href="{{ url('patient') }}">
				<div class="row align-items-center m-l-0">
					<div class="col-auto" style="text-align: center;">
						
					</div>
					<div class="col-auto">
						<h6 class="text-muted m-b-10">Total Contributers</h6>
						<h2 class="m-b-0">50</h2>
					</div>
				</div>
			</a>
			</div>
		</div>

		
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="card">
			<div class="card-block" style="padding: 32px; text-align: center;">
				<a href="{{ url('patient') }}">
				<div class="row align-items-center m-l-0">
					<div class="col-auto" style="text-align: center;">
						
					</div>
					<div class="col-auto">
						<h6 class="text-muted m-b-10">Total Upload Images</h6>
						<h2 class="m-b-0">5000</h2>
					</div>
				</div>
			</a>
			</div>
		</div>

		
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="card">
			<div class="card-block" style="padding: 32px; text-align: center;">
				<a href="{{ url('patient') }}">
				<div class="row align-items-center m-l-0">
					<div class="col-auto" style="text-align: center;">
						
					</div>
					<div class="col-auto">
						<h6 class="text-muted m-b-10">Total Payments</h6>
						<h2 class="m-b-0">500000</h2>
					</div>
				</div>
			</a>
			</div>
		</div>

		
	</div>

	<div class="col-xl-3 col-md-6">
		<div class="card">
			<div class="card-block" style="padding: 32px; text-align: center;">
				<a href="{{ url('patient') }}">
				<div class="row align-items-center m-l-0">
					<div class="col-auto" style="text-align: center;">
						
					</div>
					<div class="col-auto">
						<h6 class="text-muted m-b-10">Total Customers</h6>
						<h2 class="m-b-0">20</h2>
					</div>
				</div>
			</a>
			</div>
		</div>

		
	</div>

	
	

</div>


@endsection