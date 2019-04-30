<nav class="navbar navbar-expand-md navbar-dark bg-dark d-md-none">
    <a class="navbar-brand" href="{{ url('/') }}">
        <b>{{ $topic->name }}</b>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#subNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="subNav">

        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link @if(AppCore::getCurrentTab() === 'data') active @endif" href="/list/{{ $topic->hashids() }}">資料</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Request::path() === 'feeds/'.$topic->hashids()) active @endif" href="/feeds/{{ $topic->hashids() }}">社群動態</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Request::path() === 'contributors/'.$topic->hashids()) active @endif" href="/contributors/{{ $topic->hashids() }}">貢獻者</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Request::path() === 'add/'.$topic->hashids()) active @endif" href="/add/{{ $topic->hashids() }}">新增資料</a>
            </li>
            @if (Auth::check() && $topic->users->count())
            <li class="nav-item">
                <a class="nav-link @if(Request::path() === 'settings/'.$topic->hashids()) active @endif" href="/settings/{{ $topic->hashids() }}">設定</a>
            </li>
            @endif
        </ul>
    </div>

</nav>
