<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content"{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pilkades') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

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
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="display-4 font-weight-bold mb-4">Selamat Datang</div>
                                <div class="h1">di TPS 2</div>
                                <div class="h3">Silahkan Lakukan Scan Fingerprint untuk melakukan Pemilihan Suara</div>
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
                        <!-- <div class="card">
                            <div class="card-body text-center">
                                {!! Form::open([ 'route' => 'vote.findUser', 'method' => 'post' ]) !!}
                                <div class="form-group">
                                    <label for="">Masukan NIK untuk mulai memilih</label>
                                    <input type="text" name="nik" class="form-control" placeholder="NIK" id="">
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    $(document).ready(function() {
        function getData() {
            $.ajax({
                type: "GET",
                url: "/api/login/data",
                success: function(data) {
                    if (data.ip == "192.168.43.75") {
                        location.reload();
                    }
                }
            });
        }
        setInterval(function() {
            getData();
        }, 1000);
    });
</script>

</html>