@if(Auth::check())
<form action="/upload-photo" method="post" enctype="multipart/form-data">
    <input type="hidden" name='entity_id' value='{{ $entity->id }}'>
    <input type="file" name="image" required>
    {{ csrf_field() }}
    <br>
    <button type="submit" class='btn btn-default mt-3'
        onclick="if ($(this).parent().find('input[type=\'file\']').val() != '') {this.disabled=true; this.innerHTML='處理中，請稍候...'; this.form.submit();} else {return false;}">
        <i class='fas fa-camera'></i>&nbsp;上傳照片
    </button>
</form>
@else
<a class="btn btn-default" href='/login?from=/view/{{ $entity->hashids() }}'>
    <i class="fas fa-camera"></i>&nbsp;上傳照片
</a>
@endif
