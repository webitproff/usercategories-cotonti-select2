<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=index.tags
 * [END_COT_EXT]
 */

/**
 * Filename: usercategories.index.php
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

$t->assign([
	'USERCATEGORIES_CATALOG' => cot_usercategories_tree()
]);
