@extends(theme_path('layout'))

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include(theme_path('repo-top'))

        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">

            <div class="d-none d-lg-block">
                <div class="list-group mt-3" id="list-tab" role="tablist">
                    <a class="list-group-item @if(AppCore::getCurrentSubTab() === 'all') active @endif" href="/feeds/{{ $topic->hashids() }}" role="tab">全部動態</a>
                    <a class="list-group-item @if(AppCore::getCurrentSubTab() === 'add') active @endif" href="/feeds/{{ $topic->hashids() }}?type=add" role="tab">新增紀錄</a>
                    <a class="list-group-item @if(AppCore::getCurrentSubTab() === 'editing') active @endif" href="/feeds/{{ $topic->hashids() }}?type=editing" role="tab">編修紀錄</a>
                    <a class="list-group-item @if(AppCore::getCurrentSubTab() === 'review') active @endif" href="/feeds/{{ $topic->hashids() }}?type=review" role="tab">評分紀錄</a>
                    <a class="list-group-item @if(AppCore::getCurrentSubTab() === 'comment') active @endif" href="/feeds/{{ $topic->hashids() }}?type=comment" role="tab">留言紀錄</a>
                    <a class="list-group-item @if(AppCore::getCurrentSubTab() === 'tag') active @endif" href="/feeds/{{ $topic->hashids() }}?type=tag" role="tab">標籤紀錄</a>
                    <a class="list-group-item @if(AppCore::getCurrentSubTab() === 'photo') active @endif" href="/feeds/{{ $topic->hashids() }}?type=photo" role="tab">照片紀錄</a>
                </div>
            </div>

            <div class="d-lg-none">
                <ul class="nav nav-pills mt-3">
                    <li class="nav-item">
                        <a class="nav-link @if(AppCore::getCurrentSubTab() === 'all') active @endif" href="/feeds/{{ $topic->hashids() }}" role="tab">全部</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(AppCore::getCurrentSubTab() === 'add') active @endif" href="/feeds/{{ $topic->hashids() }}?type=add" role="tab">新增</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(AppCore::getCurrentSubTab() === 'editing') active @endif" href="/feeds/{{ $topic->hashids() }}?type=editing" role="tab">編修</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(AppCore::getCurrentSubTab() === 'review') active @endif" href="/feeds/{{ $topic->hashids() }}?type=review" role="tab">評分</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(AppCore::getCurrentSubTab() === 'comment') active @endif" href="/feeds/{{ $topic->hashids() }}?type=comment" role="tab">留言</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(AppCore::getCurrentSubTab() === 'tag') active @endif" href="/feeds/{{ $topic->hashids() }}?type=tag" role="tab">標籤</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(AppCore::getCurrentSubTab() === 'photo') active @endif" href="/feeds/{{ $topic->hashids() }}?type=photo" role="tab">照片</a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="col-lg-10">
            <h6 class="mt-3 mb-0"><b>
                @if (AppCore::getCurrentSubTab() === 'all')
                    全部動態
                @elseif (AppCore::getCurrentSubTab() === 'add')
                    新增紀錄
                @elseif (AppCore::getCurrentSubTab() === 'editing')
                    編修紀錄
                @elseif (AppCore::getCurrentSubTab() === 'review')
                    評分紀錄
                @elseif (AppCore::getCurrentSubTab() === 'comment')
                    留言紀錄
                @elseif (AppCore::getCurrentSubTab() === 'tag')
                    標籤紀錄
                @elseif (AppCore::getCurrentSubTab() === 'photo')
                    照片紀錄
                @endif
            </b></h6>
            <div class="card mt-2">
                <ul class="list-group list-group-flush">
                    @foreach ($records as $record)
                        @if ($record['type'] === 'add')
                            @include(theme_path('feeds/add'))
                        @endif
                        @if ($record['type'] === 'editing')
                            @include(theme_path('feeds/editing'))
                        @endif
                        @if ($record['type'] === 'review')
                            @include(theme_path('feeds/review'))
                        @endif
                        @if ($record['type'] === 'comment')
                            @include(theme_path('feeds/comment'))
                        @endif
                        @if ($record['type'] === 'tag')
                            @include(theme_path('feeds/tag'))
                        @endif
                        @if ($record['type'] === 'photo')
                            @include(theme_path('feeds/photo'))
                        @endif
                    @endforeach
                </ul>
                @if (count($records) === 0)
                    <div class="card-body">
                        還沒有紀錄。
                    </div>
                @endif
            </div>

            <div class="mt-3" style="overflow: auto;">
                {{ $records->links() }}
            </div>

        </div>
    </div>

</div>

<div class="mt-4"></div>

@endsection
