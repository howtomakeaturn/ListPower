<div class="mt-4">
    <a href="/list/{{ $topic->hashids() }}"><h1 class="h5 mb-0"><b>{{ $topic->name }}</b></h1></a>
</div>

<ul class="nav nav-tabs main mt-3">
    <li class="nav-item">
        <a class="nav-link @if(AppCore::getCurrentTab() === 'data') active @endif" href="/list/{{ $topic->hashids() }}">
            <i class="fas fa-home"></i>
            <span class="d-none d-md-inline">&nbsp;資料</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::path() === 'feeds/'.$topic->hashids()) active @endif" href="/feeds/{{ $topic->hashids() }}">
            <i class="fas fa-newspaper"></i>
            <span class="d-none d-md-inline">&nbsp;社群動態</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::path() === 'contributors/'.$topic->hashids()) active @endif" href="/contributors/{{ $topic->hashids() }}">
            <i class="fas fa-users"></i>
            <span class="d-none d-md-inline">&nbsp;貢獻者</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::path() === 'add/'.$topic->hashids()) active @endif" href="/add/{{ $topic->hashids() }}">
            <i class="fas fa-plus-circle"></i>
            <span class="d-none d-md-inline">&nbsp;新增資料</span>
        </a>
    </li>
    @if (Auth::check() && $topic->users->count() && in_array(Auth::user()->email, $topic->users->pluck('email')->all()))
        @if ($topic->hasAddressColumn())
            <li class="nav-item">
                <a class="nav-link @if(Request::path() === 'dashboard/'.$topic->hashids()) active @endif" href="/dashboard/{{ $topic->hashids() }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="d-none d-md-inline">&nbsp;管理</span>
                </a>
            </li>
        @endif
    <li class="nav-item">
        <a class="nav-link @if(Request::path() === 'settings/'.$topic->hashids()) active @endif" href="/settings/{{ $topic->hashids() }}">
            <i class="fas fa-cog"></i>
            <span class="d-none d-md-inline">&nbsp;設定</span>
        </a>
    </li>
    @endif
</ul>
