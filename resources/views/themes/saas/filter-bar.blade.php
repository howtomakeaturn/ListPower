@if (AppCore::getCurrentMode() !== 'map')
    @if ($topic->hasCityColumn())
        <div class="row">
            <div class="col">
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-search"></i>&nbsp;
                        {{ $topic->getFirstCityColumn()->meta_label }}：
                        @if (AppCore::getCurrentFilter())
                            <a href="/list/{{ $topic->hashids() }}" class="mr-2">
                                全部
                            </a>
                        @else
                            <span class="mr-2">全部</span>
                        @endif
                        @foreach ($topic->getValidCityNames() as $city)
                            @if (AppCore::getCurrentFilter() !== null && AppCore::getCurrentFilter()['filter'] === $city)
                                <span class="mr-2">{{ $city }}</span>
                            @else
                                <a href="/list/{{ $topic->hashids() }}?f{{ $topic->getFirstCityColumn()->id }}={{ $city }}" class="mr-2">
                                    {{ $city }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                    @if ($topic->hasAddressColumn())
                    <div class="d-none d-md-block" style="min-width: 115px; text-align: right;">
                        @include(theme_path('map-button'))
                    </div>
                    @endif
                </div>
                @if (AppCore::getCurrentFilter())
                <div class="mt-2 p-3 border bg-white rounded">
                    <h5 class="mb-0">搜尋結果 / <b>{{ AppCore::getCurrentFilter()['filter'] }}</b></h5>
                </div>
                @endif
            </div>
        </div>
    @endif
@endif

@if ($topic->hasAddressColumn() && AppCore::getCurrentMode() !== 'map')
<span class="d-block d-md-none" style="position: fixed; bottom: 1rem; z-index: 1; left: 50%; transform: translateX(-50%);">
    @include(theme_path('map-button'))
</span>
@endif
