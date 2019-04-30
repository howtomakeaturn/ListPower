@extends(theme_path('layout'))

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include(theme_path('repo-top'))

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5 class="mt-4 mb-0"><b>清單管理員</b></h5>
        </div>
    </div>

    <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
        @foreach ($topic->users as $user)
        <div class="col-xl-3 col-lg-4 col-md-6">
            @include(theme_path('contributor-card'), ['contribution' => AppCore::getContribution($topic, $user)])
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5 class="mt-4 mb-0"><b>貢獻者名單</b></h5>
        </div>
    </div>

    <div class="row no-gutters" style="margin-left: -0.5rem; margin-right: -0.5rem;">
        @foreach ($contributions as $contribution)
        <div class="col-xl-3 col-lg-4 col-md-6">
            @include(theme_path('contributor-card'))
        </div>
        @endforeach
    </div>

</div>

<div class="mt-4"></div>

@endsection
