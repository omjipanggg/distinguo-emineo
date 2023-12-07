@extends('layouts.app')
@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-2">
                            {{-- <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label> --}}

                            <div class="col-md-6 offset-md-3">
                                <input id="name" type="text" placeholder="Nama" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                            <div class="col-md-6 offset-md-3">
                                <input id="email" type="email" placeholder="Alamat email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}

                            <div class="col-md-6 offset-md-3">
                                <input id="password" type="password" placeholder="Kata sandi" class="form-control password @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label> --}}

                            <div class="col-md-6 offset-md-3">
                                <input id="password-confirm" type="password" placeholder="Kata sandi (konfirmasi)" class="form-control password" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="d-flex gap-3 align-items-center justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} onchange="eyeOpen(event);">

                                    <label class="form-check-label" for="remember">
                                        {{ __('Tampilkan kata sandi') }}
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary px-3 rounded-0">
                                    {{ __('Register') }}<i class="bi bi-key ms-2"></i>
                                </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
