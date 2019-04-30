@extends(theme_path('blank'))

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="font-weight-bold">資料預覽</h5>
                    <p class="mt-3">以下是系統從您的檔案讀取到的資料，請確認後按下一步開始建檔。</p>
                    <form method="post" action="/submit-import">
                        <input type="hidden" name="content" value="{{ $content }}">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="開始建檔">
                    </form>
                </div>
            </div>

            <div class="">
                <div class="bg-white d-inline-block -border mt-4 table-responsive">
                    <table class="table table-bordered table-hover m-0">
                        <tr>
                            @foreach ($header as $h)
                                <th>{{ $h }}</th>
                            @endforeach
                        </tr>
                        @foreach ($records as $rows)
                            <tr>
                                @foreach ($rows as $value)
                                    <td>
                                        <div class="text-truncate" style="max-width: 150px;">
                                            {{ $value }}
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4"></div>

@endsection
