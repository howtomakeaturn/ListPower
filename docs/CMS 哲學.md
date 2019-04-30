# CMS Philosophy

- app/controllers 硬改是免不了的
- routes/web.php 硬改是免不了的
- app 內一堆 model 硬改是免不了的

- 與其野心很大...
  - 大部份檔案都是系統檔案，不硬改，可升級，客製化 code 拉出來獨立撰寫

- 不如實際一點... 大部份檔案都會被硬改到
  - 至少把少數可以重用的檔案拉出來，少少幾個檔案可以升級、不硬改、作為系統檔案就好
  - 這樣才是 developer friendly, 前者是 user friendly

- 可以的話，逐漸提昇系統檔案的佔比即可
- 總之，要用標準流程更新系統是很難的。檔案能夠拖放覆蓋來升級系統就很好
- 讓 controllers, views 內容盡量少，data management layer 拉出來變成一層

- 其實，這流程，就跟 git flow 同樣？只是變成 file structure

# 系統檔案（嚴謹，能夠 sync 升級）

- system/helpers.php
- routes/system/web.php

# 主題資料夾（鬆散，隨便亂改沒關係）

- resources/views/themes/
- routes/themes/
- app/Http/Controllers/Themes/

# Todo

- global admin panel
- data management layer
- upgradable system
