@extends('layouts.auth')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Daftar</h1>
                    </div>
                    <form class="user" action="/register" method="post">
                        @csrf
                        <div class="form-group">
                            <input name="name" type="name" class="form-control form-control-user @error('name') is-invalid @enderror"
                                id="exampleInputName" aria-describedby="nameHelp"
                                placeholder="name">
                            @error('email')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input name="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                id="exampleInputEmail" aria-describedby="emailHelp"
                                placeholder="Email">
                            @error('email')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                id="exampleInputPassword" placeholder="Password">
                                @error('password')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Daftar
                        </button>
                        <hr>
                    </form>
                    <div class="text-center">
                        <a class="small" href="/login">Punya Akun?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session()->has('error'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@endsection
