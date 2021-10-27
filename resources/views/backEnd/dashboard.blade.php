@extends('backEnd.master')
@section('mainContent')
<style type="text/css">
	.card-block{
		margin: 0 auto;
	}
</style>
<div class="row">
	<div class="col-xl-3 col-md-6">
		<a href="{{ url('contributor') }}">
			<div class="card">
				<div class="card-block" style="padding: 32px;">
					<div class=" align-items-center">
						<div class="col-auto text-center">
							<h6 class="text-muted m-b-10">Total Contributers</h6>
							<h2 class="m-b-0">50</h2>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xl-3 col-md-6">
		<a href="{{ url('image_list_all') }}">
			<div class="card">
				<div class="card-block" style="padding: 32px;">
					<div class=" align-items-center">
						<div class="col-auto text-center">
							<h6 class="text-muted m-b-10">Total Upload Images</h6>
							<h2 class="m-b-0">{{$contributors}}</h2>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xl-3 col-md-6">
		<a href="{{ url('admin-withdraw-list') }}">
			<div class="card">
				<div class="card-block" style="padding: 32px;">
					<div class=" align-items-center">
						<div class="col-auto text-center">
							<h6 class="text-muted m-b-10">Total Payments</h6>
							<h2 class="m-b-0">{{ Config::get('app.curreny')}} {{$totalPayment}}</h2>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<div class="col-xl-3 col-md-6">
		<a href="{{ url('user') }}">
			<div class="card">
				<div class="card-block" style="padding: 32px;">
					<div class=" align-items-center">
						<div class="col-auto text-center">
							<h6 class="text-muted m-b-10">Total Customer</h6>
							<h2 class="m-b-0">{{$users}}</h2>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	

	
	

</div>


@endsection