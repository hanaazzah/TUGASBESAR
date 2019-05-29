@extends('layouts.app')

@section('content')
<div class="page-content">
	<div class="container">
		<div class="page-header">
			<h1 class="page-title">Tambah Data Calon Kades</h1>
		</div>
		<div class="my-3 my-md-5">
			<div class="container">
				<div class="row row">
					<div class="col col-12">
						<div class="card">
							<div class="card-body">
								{!! Form::open([ 'route' => 'kades.store', 'method' => 'post', 'files' => true ]) !!}
								<div class="row">
									<div class="col col-8">
										<div class="card">
											<div class="card-body">
												<div class="form-group">
													<label class="form-label">Nomor Urut</label>
													<input class="form-control {{ $errors->has('no_urut') ? ' is-invalid' : '' }}" name="no_urut" type="text" placeholder="No Urut .. " value="{{ old('no_urut') }}" autofocus>
													@if ($errors->has('no_urut'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('no_urut') }}</strong>
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
													<label class="form-label">Visi</label>
													<textarea name="visi" class="form-control" cols="20" rows="5"></textarea>
													@if ($errors->has('visi'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('visi') }}</strong>
													</span>
													@endif
												</div>

												<div class="form-group">
													<label class="form-label">Misi</label>
													<textarea name="misi" class="form-control" cols="20" rows="5"></textarea>
													@if ($errors->has('misi'))
													<span class="invalid-feedback">
														<strong>{{ $errors->first('misi') }}</strong>
													</span>
													@endif
												</div>
											</div>
										</div>
										<button class="btn btn-primary" type="submit">
											<span class="fe fe-save"></span> Simpan</button>
										<a href="{{route('home')}}" class="btn btn-danger">
											<span class="fe fe-rewind"></span> Batal</a>
									</div>

									<div class="col-4">
										<div class="d-flex align-items-center px-2">
											<div class="form-group">
												<div class="form-label">Foto Calon Kades</div>
												<div class="custom-file">
													<input type="file" class="custom-file-input" name="image">
													<label class="custom-file-label">Choose file</label>
												</div>
												@if ($errors->has('image'))
												<span class="invalid-feedback">
													<strong>{{ $errors->first('image') }}</strong>
												</span>
												@endif
											</div>
										</div>
									</div>
								</div>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection