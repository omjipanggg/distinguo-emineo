@extends('layouts.panel')
@section('title', 'Lounge')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Identitas Penilai</div>

                <div class="card-body">
                    <form action="{{ route('evaluator.store') }}" method="POST">
                        @method('POST')
                        @csrf

                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <div class="flex-fill">
                                @error('name')
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-floating">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="Nama">
                                    <label for="name">Nama</label>
                                </div>
                            </div>

                            <div class="flex-fill">
                                @error('email')
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-floating">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="Alamat email">
                                    <label for="email">Alamat email</label>
                                </div>
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback d-inline-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password" type="password" class="form-control mb-2 @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Kata sandi">

                        <div class="d-flex flex-wrap gap-2">
                            <div class="flex-fill">
                                <input id="password-confirm" type="password" placeholder="Kata sandi (konfirmasi)" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                            <button type="submit" class="btn btn-primary rounded-0 px-3">Submit<i class="bi bi-send ms-2"></i></button>
                        </div>

                    </form>
                </div>

                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
