<div class='bg-white rounded border p-3 mt-3 ml-2 mr-2'>
    <div style='display: inline-block;'>
        <img src='{{ $contribution['user']->avatar }}' style='border-radius: 50%; width: 50px;'>
        <!--
        <div class="text-center">
            <span class="small font-weight-bold" style="color: grey;">Exp.{{ 1,234 }}</span>
        </div>
        -->
    </div>
    <div style='display: inline-block; width: calc(100% - 65px); vertical-align: top; margin-left: 10px;'>
        <div style='overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>
            <span>{{ $contribution['user']->name }}</span>
        </div>
        <div style="color: grey;">
            <div class="row">
                <div class="col-6">
                    新增 <span class="blue-text">{{ $contribution['entityCount'] }}</span>
                </div>
                <div class="col-6">
                    編修 <span class="blue-text">{{ $contribution['editingCount'] }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    評分 <span class="blue-text">{{ $contribution['reviewCount'] }}</span>
                </div>
                <div class="col-6">
                    留言 <span class="blue-text">{{ $contribution['commentCount'] }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    標籤 <span class="blue-text">{{ $contribution['tagCount'] }}</span>
                </div>
                <div class="col-6">
                    照片 <span class="blue-text">{{ $contribution['photoCount'] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
