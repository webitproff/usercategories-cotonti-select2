<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=users.query
 * Order=99
 * [END_COT_EXT]
 */

/**
 * Filename: usercategories.users.query.php
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

$cat = cot_import('cat', 'G', 'ALP');

if (!empty($cat))
{
	$subcats = cot_structure_children('usercategories', $cat);
	if(count($subcats) > 0){
		foreach ($subcats as $val) {
			$cat_query[] = "FIND_IN_SET('".$db->prep($val)."', user_cats)";
		}
		$where['cat'] = "(".implode(' OR ', $cat_query).")";
	}else{
		$where['cat'] = "user_id=0";
	}
	$users_url_path['cat'] =  $cat;
}
