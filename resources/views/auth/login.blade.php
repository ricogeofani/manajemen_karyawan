@extends('layouts.app')

@section('content')

<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b class="text-danger">Manajemen</b>Karyawan</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body bg-dark pb-5">
          <h5 class="login-box-msg text-uppercase">Halaman Login</h5>
    
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <div class="col-md-10 col-sm-10 col-lg-10 col-9">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="email" autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              <div class="input-group-append">
                <div class="input-group-text text-light">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
                <div class="col-md-10 col-sm-10 col-lg-10 col-9">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="password" autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              <div class="input-group-append">
                <div class="input-group-text text-light">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
              <div class="col-md-11 col-lg-11 col-sm-11 col-11">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Login') }}
                </button>
              </div>
          </form>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    @endsection
