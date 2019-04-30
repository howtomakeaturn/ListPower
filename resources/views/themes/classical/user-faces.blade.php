<span style="margin-left: 7px;">
@foreach ($users as $user)
    <img src="{{ $user->avatar }}" style="height: 35px; width: 35px; border-radius: 50%; margin-left: -7px;">
@endforeach
</span>
