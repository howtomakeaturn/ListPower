<div class="row">
    <div class="col">
        <div class="mt-3 px-3 py-2 border bg-white rounded">
            <div class="row no-gutters">
                <div class="col text-center">
                    <i class="fas fa-database"></i>&nbsp;
                    <b>{{ $topic->entityCount() }}</b> <span class="d-none d-md-inline">筆資料</span>
                </div>
                <div class="col text-center">
                    <i class="fas fa-tags"></i>&nbsp;
                    <b>{{ $topic->tagCount() }}</b> <span class="d-none d-md-inline">個標籤</span>
                </div>
                <div class="col text-center">
                    <i class="fas fa-edit"></i>&nbsp;
                    <b>{{ $topic->reviewCount() }}</b> <span class="d-none d-md-inline">則評分</span>
                </div>
                <div class="col text-center">
                    <i class="fas fa-comment"></i>&nbsp;
                    <b>{{ $topic->commentCount() }}</b> <span class="d-none d-md-inline">個留言</span>
                </div>
                <!--
                <div class="col text-center">
                    <i class="fas fa-users"></i>&nbsp;
                    <b>?</b> <span class="d-none d-md-inline">人參與</span>
                </div>
                -->
            </div>
        </div>
    </div>
</div>
