@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Peserta Psikotest</h1>

        <form action="{{ $path }}">
            @if (request('psychotest_id'))
                <input type="hidden" name="psychotest_id" value="{{ request('psychotest_id') }}">
            @endif
            <div class="input-group mb-3">
                <input name="search" type="text" class="form-control bg-white border-0 " placeholder="Cari Data.." aria-label="Cari Data.." aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" id="button-addon2">
                    <i class="fas fa-fw fa-search"></i>
                  </button>
                </div>
            </div>
        </form>

        <!-- DataTales Example -->
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

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tabel Peserta Psikotest</h6>
                    <form action="{{ $path }}/create">
                        @if (request('psychotest_id'))
                            <input type="hidden" name="psychotest_id" value="{{ request('psychotest_id') }}">
                        @endif
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($data->count() != 0 )
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID Psikotest</th>
                                    <th>ID Peserta</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->psychotest_id }}</td>
                                        <td>{{ $item->user_id }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{ $path }}/{{ $item->id }}/edit" method="get">
                                                    @if (request('psychotest_id'))
                                                    <input type="hidden" name="psychotest_id" value="{{ request('psychotest_id') }}">
                                                    @endif
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fas fa-fw fa-pen"></i>
                                                    </button>
                                                </form>
                                                <a class="nav-link" href="#"
                                                    data-target="#deleteModal{{ $item->id }}" data-toggle="modal">
                                                    <i class="fas fa-fw fa-trash text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    @include('partials.delete-modal')
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @if ($data->count() == 0 && request('psychotest_id'))
                        <p class="text-center">Tidak ada peserta, silahkan untuk menambahkan</p>
                    @endif
                    @if ($data->count() == 0 && !request('psychotest_id'))
                        <p class="text-center">Tidak ada data</p>
                    @endif
                </div>
            </div>
        </div>
        {{ $data->links() }}

    </div>
@endsection
