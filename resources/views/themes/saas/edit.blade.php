@extends(theme_path('layout'))

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @include(theme_path('repo-top'))

        </div>
    </div>
</div>

<div class='container'>

    <div class='row'>
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="card-title">您正在對「{{ $entity->name }}」編輯資料。</h3>
                    <form method="post" action="/submit-edit">
                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{ $entity->id }}">

                        <div class="form-group">
                            <label for="">名稱</label>
                            <input type="text" name="name" class="form-control" value="{{ $entity->name }}" required>
                        </div>

                        @foreach ($entity->topic->sortedInfoSections() as $section)
                            @foreach ($section->sortedInfoColumns() as $column)
                                @include(theme_path('_new-edit-form-column'))
                            @endforeach
                        @endforeach

                        <button type="submit" class="btn btn-primary btn-block">更新資料</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<br>

@endsection
