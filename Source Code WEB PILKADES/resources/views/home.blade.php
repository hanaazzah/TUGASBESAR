@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">Data Calon Kepala Desa</h1>
        <div class="page-options">
            <a href="{{ route('kades.add') }}" class="btn ml-5 btn-primary btn-lg">
                <i class="fe fe-plus fe"></i> Tambah Data Calon Kades
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
        <div class="card-body">
            <div class="row">
                @if($kades->count() > 0)
                @foreach($kades as $key => $row)
                <div class="col-lg-6">
                    <div class="card card-profile">
                        <div class="card-header" style="background-image: url('https://preview.tabler.io/demo/photos/eberhard-grossgasteiger-311213-500.jpg');"></div>
                        <div class="card-body text-center">
                            <img class="card-profile-img" src="/storage/images/{{$row->image}}">
                            <h3 class="mb-3">{{ $row->no_urut }}</h3>
                            <h3 class="mb-3">{{ $row->name }}</h3>
                            <p class="mb-4">
                                <b>Visi : </b> <br>{{$row->visi}}
                            </p>

                            <p class="mb-4">
                                <b>Misi : </b> <br>{{$row->misi}}
                            </p>
                            <form action="{{route('kades.delete',[$row->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="submit">
                                    <span class="fa fa-trash"></span> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection