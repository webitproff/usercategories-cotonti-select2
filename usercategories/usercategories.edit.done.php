<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=users.profile.update.done, users.register.add.done, users.edit.update.done
 * [END_COT_EXT]
 */
/**

/**
 * Filename: usercategories.edit.done.php
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

if($ruser['user_cats'] != $urr['user_cats'])
{
	$_cats = $urr['user_cats'].','.$ruser['user_cats'];
	$rcats = explode(',', $_cats);
	if(count($rcats) > 0)
	{
		$rcats = array_unique($rcats);
		$rcats = array_diff($rcats, array(''));
		foreach ($rcats as $cat) 
		{
			cot_usercategories_sync($cat);
		}
	}
}