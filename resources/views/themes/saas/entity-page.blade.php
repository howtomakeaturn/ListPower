@extends(theme_path('layout'))

@section('head')
<link rel="stylesheet" href="/vendor/gallery/css/blueimp-gallery.min.css">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include(theme_path('repo-top'))

        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8">

            <div class="card mt-3">
                <div class="card-body">
                    <h2 class="h3"><b>{{ $entity->name }}</b></h2>
                    <hr class="mb-4">
                    @include(theme_path('tag-section'))
                    @if ($entity->topic->reviewColumns->count())
                        @include(theme_path('review-section'))
                    @endif
                    @include(theme_path('info-section'))
                    @include(theme_path('photo-section'))
                    @include(theme_path('comment-section'))
                </div>
            </div>

        </div>
        <div class="col-lg-4">

            @if ($topic->hasAddressColumn() && $entity->getAddressInfo())
            <div class="card mt-3">
                <div class="card-body pb-0 px-2 pt-2">
                    <iframe
                        width="100%"
                        height="250"
                        frameborder="0"
                        src="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLE_MAP_KEY') }}&q={{ $entity->addressForGoogle() }}">
                    </iframe>
                </div>
            </div>
            @endif

            <div class="card mt-3">
                <div class="card-header">
                    參與貢獻資料
                </div>
                <div class="card-body">
                    <div>
                        <div class="btn-group w-100" role="group">
                            @if ($entity->topic->reviewColumns->count())
                            <a class="btn btn-default" href="/review/{{ $entity->hashids() }}">
                                @if (Auth::check() && App\Review::where('entity_id', $entity->id)->where('user_id', Auth::user()->id)->count())
                                    <i class="fas fa-edit"></i>&nbsp;修改評分
                                @else
                                    <i class="fas fa-edit"></i>&nbsp;我要評分
                                @endif
                            </a>
                            @endif

                            <a class="btn btn-default" href="/edit/{{ $entity->hashids() }}">
                                <!--
                                <i class="fas fa-hammer"></i>&nbsp;提出修改
                                -->
                                <i class="fas fa-pen"></i>&nbsp;編修資訊
                            </a>

                            <a class="btn btn-default" href="/tag/{{ $entity->hashids() }}">
                                <!--
                                <i class="fas fa-hammer"></i>&nbsp;提出修改
                                -->
                                <i class="fas fa-tags"></i>&nbsp;標籤
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    上傳照片
                </div>
                <div class="card-body">
                    <div>
                        <div class="btn-group w-100" role="group">

                            @include(theme_path('upload-photo-button'))

                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    資料來源
                </div>
                <div class="card-body">
                    @if ($entity->topic->reviewColumns->count())
                    <a href="/reviews/{{ $entity->hashids() }}">{{ $entity->reviews->count() }} 人評分</a>，
                    @endif
                    {{ $entity->editings->count() }} 次編修，{{ $entity->comments->count() }} 則留言
                    <hr>
                    <span style="" class="mr-1">{{ $entity->getContributors()->count() }} 位貢獻者</span>
                    @include(theme_path('user-faces'), ['users' => $entity->getContributors()])
                </div>
            </div>

            <!--
            <div class="card mt-3">
                <div class="card-header">
                    清單簡介
                </div>
                <div class="card-body">
                    <div><a href="/list/{{ $entity->topic->hashids() }}">{{ $entity->topic->name }}</a></div>
                    <div class="mt-2 text-muted">{{ $entity->topic->description }}</div>
                </div>
            </div>
            -->

            <!--
            <div class="card mt-3">
                <div class="card-body">
                    <div>隸屬於：台北最適合工作的咖啡廳清單</div>
                    <div class="mt-2">basic info ...</div>
                    <hr>
                    contributor info ...
                </div>
            </div>
            -->
        </div>
    </div>
</div>

<div class="mt-4"></div>

@endsection
