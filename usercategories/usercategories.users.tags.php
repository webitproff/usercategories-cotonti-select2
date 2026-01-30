<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=users.tags
 * [END_COT_EXT]
 */

/**
 * Filename: usercategories.users.tags.php
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


// $cat = cot_import('cat', 'G', 'TXT');
// $categories = array_keys(cot::$structure['usercategories']);

$t->assign(array(
	'USERCATEGORIES_SEARCH_CAT' => cot_usercategories_selectcat2($cat, 'cat'),
	'USERCATEGORIES_CATALOG' => cot_usercategories_tree($cat),
    'USERS_CHOSEN_CATEGORY' => cot_usercategories_chosen($cat),
));

if(!empty($cat) && is_array($structure['usercategories'][$cat]))
{
	foreach ($structure['usercategories'][$cat] as $field => $val)
	{
		$t->assign('CAT'.strtoupper($field), $val);
	}
}