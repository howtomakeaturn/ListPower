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

# 系統檔案

- system helpers.php
- ...define it
- ...define it
