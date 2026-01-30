<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=users.profile.tags, users.register.tags, users.edit.tags
 * [END_COT_EXT]
 */

/**
 * Filename: usercategories.edit.tags.php
 * User Categories plugin for Cotonti 0.9.26, PHP 8.4+
 * Version: 3.6.27
 * Date: Jan 30th, 2026
 * Adaptation: webitproff, 2026 | https://github.com/webitproff 
 * @package usercategories
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks.ru, littledev.ru, Cotonti Team
 * @license BSD
 */


defined('COT_CODE') or die('Wrong URL.');

require_once cot_incfile('usercategories', 'plug');

$prfx = 'USERS_REGISTER_';
if ($m == 'edit')
{
	$prfx = 'USERS_EDIT_';
}
elseif ($m == 'profile')
{
	$prfx = 'USERS_PROFILE_';
}
if ($prfx != 'USERS_REGISTER_') {
    $rcats = [];
    if (!empty($urr['user_cats'])) {
        $rcats = explode(',', $urr['user_cats']);
    }
}
$t->assign([
	$prfx . 'CAT' => cot_usercategories_treecheck(!empty($rcats) ? $rcats : [], 'rcats[]')
]);
