@extends('layouts.app')

@section('content')
<div class="page-content">
	<div class="container">
		<div class="page-header">
			<h1 class="page-title">Tambah Pemilih</h1>
		</div>
		<div class="my-3 my-md-5">
			<div class="container">
				<div class="row row">
					<div class="col col-8">
						<div class="card">
							<div class="card-body">
								<div class="row row">
									<div class="col col-12">
										{!! Form::open([ 'route' => 'pemilih.store', 'method' => 'post']) !!}
										<div class="card">
											<div class="card-body">
												<div class="form-group">
													<label class="form-label">NIK</label>
													<input class="form-control {{ $errors->has('nik') ? ' is-invalid' : '' }}" name="nik" type="text" placeholder="NIK .. " value="{{ old('nik') }}" autofocus> @if ($errors->has('nik'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('nik') }}</strong>
													</span>
													@endif
												</div>

												<div class="form-group">
													<label class="form-label">Nama</label>
													<input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" placeholder="Nama .. " value="{{ old('name') }}" autofocus> @if ($errors->has('name'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('name') }}</strong>
													</span>
													@endif
												</div>

												<div class="form-group">
													<label class="form-label">Jenis Kelamin</label>
													<select name="gender" class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}">
														<option value="L">Laki-Laki</option>
														<option value="P">Perempuan</option>
													</select>
													@if ($errors->has('gender'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('gender') }}</strong>
													</span>
													@endif
												</div>

												<div class="form-group">
													<label class="form-label">Umur</label>
													<input class="form-control {{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" type="number" placeholder="Umur .. " value="{{ old('age') }}" autofocus> @if ($errors->has('age'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('age') }}</strong>
													</span>
													@endif
												</div>

												<div class="form-group">
													<label class="form-label">Fingerprint</label>
													<select name="status_finger" class="form-control {{ $errors->has('status_finger') ? ' is-invalid' : '' }}">
														<option value="yes">Ya</option>
														<option value="no">Tidak</option>
													</select>
													@if ($errors->has('status_finger'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('status_finger') }}</strong>
													</span>
													@endif
												</div>


											</div>
										</div>
										<button class="btn btn-primary" type="submit">
											<span class="fe fe-save"></span> Simpan</button>
										<a href="{{route('pemilih.index')}}" class="btn btn-danger">
											<span class="fe fe-rewind"></span> Batal</a>
										{!! Form::close() !!}
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-4">
						<span class="text-muted">
							* SIlahkan Isi data pemilih
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection