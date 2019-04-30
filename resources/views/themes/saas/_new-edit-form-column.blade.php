<div class="form-group">
    <label for="">{{ $column->meta_label }}</label>
    @if ($column->meta_type === 'string' || $column->meta_type === 'address')
    <input type="text" name="{{ $column->meta_key }}" class="form-control">
    @elseif ($column->meta_type === 'city')
    <select name="{{ $column->meta_key }}" class="form-control">
        <option value="" selected disabled>請選擇</option>
        @foreach (config('city') as $value)
            <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select>
    @endif
</div>

<script>
    @if (isset($entity))
        $(document).ready(function(){
            @if ($column->meta_type === 'string' || $column->meta_type === 'address')
                @if ($entity->info($column->meta_key) !== null)
                    $('input[name="{{ $column->meta_key }}"]').val({!! json_encode($entity->info($column->meta_key)) !!});
                @endif
            @elseif ($column->meta_type === 'city')
                @if (in_array($entity->showInfo($column->meta_key), config('city')))
                    $('select[name="{{ $column->meta_key }}"]').val('{{ $entity->info($column->meta_key) !== null ? ($entity->info($column->meta_key)) : '' }}');
                @endif
            @endif
        });
    @endif
</script>
