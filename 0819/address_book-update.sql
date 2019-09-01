UPDATE `address_book` SET `name` = '陳百安', `email` = 'BaiAng@gmail.com', `address` = '花蓮縣大里區xx路151項5弄8號' WHERE `address_book`.`sid` = 1;
-- UPDATE 目標資料表
-- SET 修改欄位 = 更新的值
-- WHERE 類似判斷條件 `address_book`.`sid` 哪張資料表(可省略).哪個欄位 = 1(沒指定欄位預設整張)