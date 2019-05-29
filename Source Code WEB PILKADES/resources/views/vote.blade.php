<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Pilkades') }}</title>

	<!-- Scripts -->
	<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script> -->
	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>

<body>
	<div id="app">
		<div class="header py-4">
			<div class="container">
				<div class="d-flex">
					<a class="header-brand" href="/">
						<img src="https://pasundanekspres.co/wp-content/uploads/2019/01/lo.jpg" class="header-brand-img" alt="tabler logo">
					</a>
					<h2>Pilkades 2019 Desa. Cibiru Wetan</h2>
					<div class="d-flex order-lg-2 ml-auto">
					</div>
				</div>
			</div>
		</div>

		<div class="my-3 my-md-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body p-3 text-center">
								<div class="h1 m-0">Real Count Pemilihan Kepala Desa</div>
							</div>
						</div>
					</div>
					@if($kades->count() > 0)
					@foreach($kades as $key => $value)
					<div class="col-lg-6">

						<div class="card card-profile">
							<div class="card-header" style="background-image: url('https://preview.tabler.io/demo/photos/eberhard-grossgasteiger-311213-500.jpg');">
							</div>
							<div class="card-body text-center">
								<img class="card-profile-img" src="/storage/images/{{$value->image}}">
								<h3 class="mb-3">{{ $value->name }}</h3>
								<div class="card">
									<div class="card-body p-3 text-center">
										<div class="text-right text-green">
											<div id="persentation-{{$value->id}}">
												0
											</div>
											%
											<i class="fe fe-chevron-up"></i>
										</div>
										<div class="h1 m-0">
											<div id="realcount-{{$value->id}}">0</div>
										</div>
										<div class="text-muted mb-4">Jumlah Suara</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@endif
				</div>
			</div>
		</div>
</body>>
<script>
	$(document).ready(function() {
		function getData() {
			$.ajax({
				type: "GET",
				url: "/counts",
				success: function(data) {
					$.each(data, function(index, value) {
						var idKades = "#realcount-" + value.id_kades;
						var idKadesPersentation = "#persentation-" + value.id_kades;
						$(idKades).html(value.count);
						$(idKadesPersentation).html(value.persentase);
					});
				}
			});
		}
		setInterval(function() {
			getData();
		}, 1000);
	});
</script>

</html>