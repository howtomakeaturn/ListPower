@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include('repo-top')

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-body">
                    @foreach ($entities as $entity)
                        <div class="row @if(!$loop->last) border-bottom @endif">
                            <div class="col">
                                <div class="p-2">
                                    {{ $entity->name }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-2">
                                    {{ $entity->getAddressInfo() }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-2">
                                    {{ $entity->showLatitude() }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-2">
                                    {{ $entity->showLongitude() }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-2">
                                    <form method="post" action="/fetch-coordinate">
                                        <input type="hidden" name="id" value="{{ $entity->id }}">
                                        {{ csrf_field() }}
                                        <button class="btn btn-primary">Fetch</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>

<div class="mt-4"></div>

@endsection
