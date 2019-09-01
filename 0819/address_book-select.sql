SELECT `name` FROM `address_book` WHERE `name` LIKE '%小%'
-- 找名字欄位內有包含(小明)的選項，顯示名字欄位

SELECT `name` FROM `address_book` WHERE `name` LIKE '小%'
-- 找名字欄位內字首有包含(小明)的選項，顯示名字欄位

SELECT `name` FROM `address_book` WHERE `name` LIKE '%小'
-- 找名字欄位內字尾有包含(小明)的選項，顯示名字欄位

SELECT `name`, `email` FROM `address_book` WHERE `sid` = 1 OR `sid` = 4
-- 找流水號欄位內(1 or 4 ) 1跟4 的選項，顯示名字欄位,電子郵件

SELECT `name`, `email` FROM `address_book` WHERE `sid` = 1 AND `name` LIKE '%小名%'
