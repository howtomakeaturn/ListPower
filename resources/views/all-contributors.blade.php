@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5 class="mt-4 mb-0"><b>貢獻者名單</b></h5>
        </div>
    </div>

    <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
        @foreach ($contributions as $contribution)
        <div class="col-xl-3 col-lg-4 col-md-6">
            @include('contributor-card')
        </div>
        @endforeach
    </div>

</div>

<div class="mt-4"></div>

@endsection
