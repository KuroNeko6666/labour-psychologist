@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Profile</h1>

        <!-- DataTales Example -->
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Profile</h6>
            </div>
            <div class="card-body p-4">

                <form action="{{ $path }}/{{ $data->id }}/edit" method="get">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">ID</label>
                        <div class="col-sm-10">
                            <p class="fs-6">{{ $data->id }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <p class="fs-6">{{ $data->name }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <p class="fs-6">{{ $data->email }}</p>
                        </div>
                    </div>

                    <div class="form-group row justify-content-start">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>

            </div>
        </div>

    </div>

@endsection
