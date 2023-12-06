@extends('layouts.app')
@section('title', 'Settings')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Settings') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are currently in the SETTINGS page.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
