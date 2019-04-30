<form style='display: inline;' method="post" action=/tag/apply-tag>
    {{csrf_field()}}
    <input type='hidden' name='entity_id' value='{{ $entity->id }}'>
    <input type='hidden' name='tag_id' value='{{ $tag->id }}'>
    <button type="submit" class="btn btn-sm btn-default">
        <i class="fas fa-plus-circle"></i>
        <span>同意</span>
    </button>
</form>
