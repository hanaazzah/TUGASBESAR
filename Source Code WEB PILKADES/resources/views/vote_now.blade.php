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
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body text-center">
								<div class="h3">NIK : {{ $getUser->nik }}, Nama : {{ $getUser->name }}</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body text-center">
								<div class="h3">Silahkan Pilih Calon Kepala Desa yang Layak Menurut Anda</div>
							</div>
						</div>
					</div>
					@if($kades->count() > 0)
					@foreach($kades as $key => $value)
					<div class="col-lg-6">
						<div class="card card-profile">
							<div class="card-header" style="background-image: url('https://preview.tabler.io/demo/photos/eberhard-grossgasteiger-311213-500.jpg');"></div>
							<div class="card-body text-center">
								<img class="card-profile-img" src="/storage/images/{{$value->image}}">
								<h3 class="mb-3">{{ $value->name }}</h3>
								<div class="card">
									<a href="" class="btn btn-success btn-sm"></i>
										Lihat Visi & Misi
									</a><br>
									<form action="{{route('vote.select')}}" method="POST">
										@csrf
										<input type="hidden" name="id_pemilih" value="{{ $getUser->id }}">
										<input type="hidden" name="id_kades" value="{{ $value->id }}">
										<button class="btn btn-outline-primary btn-sm" style="height: 70px; font-size: 21px;">
											<span class="fe fe-user-check" style="font-size: 21px;"></span> Pilih Saya
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@endif
				</div>
			</div>
		</div>
</body>

</html>