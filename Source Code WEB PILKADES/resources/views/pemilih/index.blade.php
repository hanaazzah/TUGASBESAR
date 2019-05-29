@extends('layouts.app')

@section('content')
<div class="container">
	<div class="page-header">
		<h1 class="page-title">Data Pemilih</h1>
		<div class="page-options">
			<a href="{{ route('pemilih.create') }}" class="btn ml-5 btn-primary btn-lg">
				<i class="fe fe-plus fe"></i> Tambah Data Pemilih
			</a><br>
		</div>
	</div>
	@if ($message = Session::get('success'))
	<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert"></button>
		<strong>{{ $message }}</strong>
	</div>
	@endif

	@if ($message = Session::get('error'))
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert"></button>
		<strong>{{ $message }}</strong>
	</div>
	@endif

	@if ($message = Session::get('warning'))
	<div class="alert alert-warning alert-block">
		<button type="button" class="close" data-dismiss="alert"></button>
		<strong>{{ $message }}</strong>
	</div>
	@endif

	@if ($message = Session::get('info'))
	<div class="alert alert-info alert-block">
		<button type="button" class="close" data-dismiss="alert"></button>
		<strong>{{ $message }}</strong>
	</div>
	@endif

	@if ($errors->any())
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert"></button>
		Please check the form below for errors
	</div>
	@endif
	<div class="card">
		<div class="card-header" style="padding: -3.5rem; min-height: 5.5rem;">
			<div class="page-options d-flex">
				<form action="">
					<div class="input-icon ml-2">
						<span class="input-icon-addon">
							<i class="fe fe-search"></i>
						</span>
						<input type="text" name="keyword" class="form-control w-10" placeholder="Search Bumd ..">
					</div>
				</form>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table card-table table-vcenter text-nowrap">
					<thead>
						<tr>
							<th class="w-1">No.</th>
							<th>NIK</th>
							<th>Nama</th>
							<th>JK</th>
							<th>Umur</th>
							<th>Finger Print</th>
							<th class="w-1">Action</th>
						</tr>
					</thead>
					<tbody>
						@if($pemilih->count() > 0)
						@foreach($pemilih as $key => $row)
						<tr>
							<td>
								<span class="text-muted">{{ $key+1 }}</span>
							</td>
							<td>
								{{ $row->nik }}
							</td>
							<td>
								{{ $row->name }}
							</td>
							<td>
								{{ $row->gender }}
							</td>
							<td>
								{{ $row->age }}
							</td>
							<td width="20px">
								@if($row->status_finger == 'yes')
								<div class="alert alert-success alert-block" style="text-align: center">
									<strong>Ya</strong>
								</div>
								@else
								<div class="alert alert-danger alert-block" style="text-align: center">
									<strong>No</strong>
								</div>
								@endif
							</td>
							<td>
								<a href="" class="btn btn-outline-primary btn-sm">
									<span class="fe fe-eye"></span>
								</a>
								<a href="" class="btn btn-outline-success btn-sm">
									<span class="fe fe-edit"></span>
								</a>
								<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteModal5">
									<span class="fe fe-trash"></span>
								</button>
							</td>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
			<div class="border-top border-bottom card-body d-flex align-items-center mb-4  justify-content-end">
			</div>
		</div>
	</div>
</div>
@endsection