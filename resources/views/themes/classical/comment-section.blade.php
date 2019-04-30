<hr class="mt-4 mb-4">
<h5 class="mb-3"><b>{{ $entity->comments->count() }}則留言</b></h5>
<?php Carbon\Carbon::setLocale('zh-TW'); ?>
@foreach ($entity->comments as $comment)
    <div class="">
        <div class="">
            <img src="{{ $comment->user->avatar }}" style="height: 45px; border-radius: 50%;">&nbsp;
            <div class="d-inline-block ml-2" style="vertical-align: top;">
                <div>{{ $comment->user->name }}</div>
                <div class="text-muted" style="font-size: 93.333333%;">{{ $comment->created_at->diffForHumans() }}</div>
            </div>
        </div>
        <div class="mt-2 linkify">
            {{ $comment->content }}
        </div>
    </div>
    <hr>
@endforeach

@auth
<form method="post" action="/submit-comment">
    {{ csrf_field() }}
    <input type="hidden" name="entity_id" value="{{ $entity->id }}">
    <textarea placeholder="您的留言..." rows="3" class="form-control" name="body" style="width: 100%; vertical-align: bottom; margin-top: 5px;" required></textarea>
    <button type="submit" class="btn btn-primary" style="margin-top: 10px; float: right;">發佈留言</button>
</form>
@else
<a style="font-size: 0.875rem;" href="/login?from=/view/{{ $entity->hashids() }}">登入之後發表留言</a>
@endauth
