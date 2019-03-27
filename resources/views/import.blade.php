@extends('layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card mt-4">
                <div class="card-body">
                    <form action="/import" method="post" enctype="multipart/form-data">
                        <h5 class="font-weight-bold">從檔案匯入資料</h5>
                        <p class="mt-3">上傳一個 csv 檔案，直接匯入之後建立表單與資料。</p>
                        <input type="file" name="file" required>
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="下一步">
                    </form>
                </div>
            </div>

            <!--
            <div class="card mt-4">
                <div class="card-body">
                    <form action="/parse" method="post" enctype="multipart/form-data">
                        <h5 class="font-weight-bold">test data</h5>
                        <p class="mt-3">test the file to see if it's correctly parsed.</p>
                        <input type="file" name="file" required>
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>
            -->

        </div>
    </div>
</div>

<div class="mt-4"></div>

@endsection
