@extends('layouts.index')
@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @include('components.hero')
        </div>
    </div>
</div>
@endsection
