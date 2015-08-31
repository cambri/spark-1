@extends('spark::layouts.settings')

<!-- Scripts -->
@section('scripts')
	@include('spark::scripts.common')

	<script src="//cdnjs.cloudflare.com/ajax/libs/URI.js/1.15.2/URI.min.js"></script>
@endsection

<!-- Main Content -->
@section('content')
<spark-simple-register-screen inline-template>
	<div id="spark-register-screen" class="container-fluid spark-screen">
		<!-- Invitation -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@include('spark::auth.registration.subscription.invitation')
			</div>
		</div>

		<!-- Basic Information -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@include('spark::auth.registration.simple.basics')
			</div>
		</div>
	</div>
</spark-register-screen>
@endsection
