@extends(theme_path('layout'))

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h5 class="mt-4 mb-0"><b>ListBox？清單盒子？這是什麼網站呢？</b></h5>
            <div class="card mt-3">
                <div class="card-body">
                    <p>你好，謝謝你對這個網站有興趣。我是作者 {!! me_img() !!} 阿川 。</p>
                    <p>ListBox 是一個整理各種資料清單的平台，任何人都可以在上面建立清單、與同好一起整理資料。</p>
                    <!--
                    <p>ListBox 讓大家可以彼此分享情報、做出各種由社群產生的資料清單。</p>
                    -->
                    <hr>
                    <h5 class="mb-3"><b>網站起源</b></h5>
                    <p>我在2016年的時候做了一個網站，蒐集「最適合工作的咖啡廳清單」：<a href="https://cafenomad.tw/">Cafe Nomad</a></p>
                    <p>Cafe Nomad 網站讓網友們可以一起蒐集咖啡廳資料、評分、留言，等等。</p>
                    <p>ListBox 是「不限主題、開放平台」版本的 Cafe Nomad，每個人都能直接用它建立清單！</p>
                    <p>你可以自行決定有哪些評分欄位、資訊欄位，建立之後，你就是清單的管理員，可以維護、管理清單！</p>
                    <p class="mb-0">與社群一起分享資料，是一件非常有趣的事情。歡迎你也來試試看！</p>
                </div>
            </div>
        </div>
    </div>



</div>

<div class="mt-4"></div>

@endsection
