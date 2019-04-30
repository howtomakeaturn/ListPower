<div class="mt-2">
    <div class="d-inline-block">
        @if ($fields[$i][2] === 'address')
            @if ($fields[$i][1])
                {{ $fields[$i][0] }}：<a href="{{ addressLink($entity->addressForGoogle()) }}" target="_blank">{{ $fields[$i][1] }}
                    <i class="fas fa-external-link-alt fa-sm"></i>
                </a>
            @else
                {{ $fields[$i][0] }}：
            @endif
        @else
            {{ $fields[$i][0] }}：<span class="text-muted linkify">{{ $fields[$i][1] }}</span>
        @endif
    </div>
</div>
