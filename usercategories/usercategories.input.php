<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=input
 * [END_COT_EXT]
 */

/**
 * Filename: usercategories.input.php
 * User Categories plugin for Cotonti 0.9.26, PHP 8.4+
 * Version: 3.6.27
 * Date: Jan 30th, 2026
 * Adaptation: webitproff, 2026 | https://github.com/webitproff 
 * @package usercategories
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks.ru, littledev.ru, Cotonti Team
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

$sql_config = $db->query("SELECT * FROM $db_config");
while ($row = $sql_config->fetch())
{
	if ($row['config_cat'] == 'usercategories')
	{
		if (empty($row['config_subcat']))
		{
			$cfg[$row['config_cat']][$row['config_name']] = $row['config_value'];
		}
		else
		{
			$cfg[$row['config_cat']]['cat_' . $row['config_subcat']][$row['config_name']] = $row['config_value'];
		}
	}
}
$sql_config->closeCursor();

$cot_modules['usercategories'] = [
	'code' => 'usercategories',
	'title' => 'User Categories',
	'version' => '3.6.27'
];