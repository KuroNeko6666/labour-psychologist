@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Ubah Jadwal Psikotest</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Formulir Ubah Jadwal Psikotest</h6>
            </div>
            <div class="card-body">

                <form action="{{ $path }}/{{ $data->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-2 col-form-label">ID User</label>
                        <div class="col-sm-10">
                            <input name="user_id" type="number" class="form-control @error('user_id') is-invalid @enderror"
                                id="user_id" list="user" value="{{ $data->user_id }}">
                            <datalist id="user">
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </datalist>
                            @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="psychologist_id" class="col-sm-2 col-form-label {{ request('psychotest_id')? 'd-none' : '' }}">ID Psikolog</label>
                        <div class="col-sm-10">
                            <input name="psychotest_id" type="{{ request('psychotest_id')? 'hidden' : 'number' }}"
                                class="form-control @error('psychotest_id') is-invalid @enderror" id="psychotest_id"
                                list="psychotest" value="{{ request('psychotest_id') ?? $data->psychotest_id }}">
                            <datalist id="psychotest">
                                @foreach ($psychotest as $item)
                                    <option value="{{ $item->id }}">{{ $item->location }}</option>
                                @endforeach
                            </datalist>
                            @error('psychotest_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    @if (request('psychotest_id'))
                        <input type="hidden" name="psychotest" value="{{ request('psychotest_id') }}">
                    @endif

                    <div class="form-group row justify-content-end">
                        <a href="{{ request('psychotest_id')? $path.'?psychotest_id='.request('psychotest_id') : $path }}" class="btn btn-light text-primary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
