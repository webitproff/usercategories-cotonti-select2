
/**
 * Completely removes usercategories data
 * usercategories.uninstall.sql
 */

DELETE FROM `cot_structure` WHERE structure_area = 'usercategories';
DELETE FROM `cot_auth` WHERE auth_code = 'usercategories';
ALTER TABLE `cot_users` DROP COLUMN `user_cats`;

