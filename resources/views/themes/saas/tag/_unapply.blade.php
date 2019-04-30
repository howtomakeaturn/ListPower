<form style='display: inline;' method="post" action="/tag/unapply-tag">
    {{csrf_field()}}
    <input type='hidden' name='entity_id' value='{{ $entity->id }}'>
    <input type='hidden' name='tag_id' value='{{ $tag->id }}'>
    <button type="submit" class="btn btn-sm btn-link">
        取消
    </button>
</form>
