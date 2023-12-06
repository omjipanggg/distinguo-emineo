@extends('layouts.panel')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('evaluation.index') }}
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-6">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if ($queries)
                        @foreach ($queries as $key => $query)
                            @if ($key === 'user')
                                <p class="display-5">Selamat datang, <span class="fw-bold display-5">{{ $query }}</span>!</p>
                            @endif
                        @endforeach
                    @endif
                    <p class="m-0 text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quam veniam eius quos, iusto quae et debitis eveniet dignissimos ullam commodi maiores quo omnis blanditiis voluptatibus dolorem, cumque ex. Error odit eum cumque earum nihil, repudiandae excepturi quis deleniti quam quos alias architecto soluta non nisi modi eos! Vel adipisci error minus asperiores temporibus provident quidem, minima placeat voluptates similique sed totam vitae magnam rerum impedit rem magni soluta! Magni, odit totam unde mollitia consequuntur, impedit. Velit est dicta voluptatum alias delectus doloremque minima odio, odit saepe provident, natus. Dolore quasi eligendi corrupti quisquam est, deserunt sequi fugiat, ea sint sit.</p>
                </div>

                <div class="card-footer"></div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="text-justify">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta harum labore quia incidunt repellat, hic itaque assumenda provident est excepturi, a consequuntur, sit quisquam possimus quibusdam laborum! Tempore magni fugiat est qui expedita accusamus nobis ullam minima odit temporibus possimus, praesentium magnam voluptates quo non animi unde, tempora dignissimos sapiente laborum, officiis dolorem consequatur? Soluta delectus id quo molestiae earum sed laboriosam ex quisquam ad illum odio a obcaecati tenetur aspernatur ratione alias et distinctio vero, adipisci dolorem. Amet libero aperiam adipisci repellat asperiores harum sunt similique, sequi! Libero delectus sed obcaecati! Minus vel, enim animi architecto, tempore temporibus omnis.
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
