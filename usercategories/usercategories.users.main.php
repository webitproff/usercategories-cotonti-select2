<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=users.main
 * [END_COT_EXT]
 */

/**
 * Filename: usercategories.users.main.php
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
// мое опционально
// $catDescr = htmlspecialchars(strip_tags(Cot::$structure['usercategories'][$cat]['desc']));
// $catTitle = htmlspecialchars(strip_tags(Cot::$structure['usercategories'][$cat]['title']));
// Cot::$out['desc'] = $catDescr;
// Cot::$out['subtitle'] = $catTitle;

if (!empty($cfg['usercategories']['cat_' . $cat]['keywords']))
{
	$out['keywords'] = $cfg['usercategories']['cat_' . $cat]['keywords'];
}
if (!empty($cfg['usercategories']['cat_' . $cat]['metadesc']))
{
	$out['desc'] = $cfg['usercategories']['cat_' . $cat]['metadesc'];
}
if (!empty($cfg['usercategories']['cat_' . $cat]['metatitle']))
{
	$out['subtitle'] = $cfg['usercategories']['cat_' . $cat]['metatitle'];
}