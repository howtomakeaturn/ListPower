# ListBox 系統目標

- 能作為獨立平台使用，讓用戶整理各種清單、蒐集大量資料
- 能 private 出租部份清單給用戶
- 能作為 CMS 單獨幫客戶安裝

# 關於 data type

- 評分相關的欄位，data 通通都是整數！
- 資訊相關的欄位，data 通通都是字串！
- 所以 database layer 內，事情非常單純！
- web app 要怎麼呈現這些資料，是 web app 的事！

# 關於 JSON

- 只有清單的設定檔，在編輯時會轉為 JSON 透過 React App 操作
- 其他地方都是直接存取 DB，不用與 JSON 來回轉換
- 若有 JSON 被存進 DB，只能是 cache 機制的內容

# 關於 database 的 table 內 row 多與缺的情形

- 更新過的清單，資料會有 legacy rows 存在 db。但沒關係吧！
- review_cells, editing_cells, review_fields, info_fields 都會
- 沒資料的欄位，沒填寫的評分，連 row 都不存。就跟中期新增 column 的情況一樣。缺 row 很正常。

# 關於資訊欄位為什麼只是字串，沒有自己的資料結構

- 而新增、編輯頁面，就只是提供預設值用戶填入而已
- field type 只是決定如何 render 這字串而已
- boolean 就當作 yes/no 選項
- 不支援「多選」這種資料

# 其他補充

- 除了 ui helper, presenter 之外，所有 function 不要在缺 row 時回傳預設值。丟 exception 或是回傳 null 就好。
  - 這樣，讓 application layer 不要被蒙在鼓裡

# Design Principle

- 不需要猜、不需要 double take、查看抽象背後的內容
- 不要有 inner platform problem
