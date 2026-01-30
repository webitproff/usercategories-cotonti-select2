<?php
/**
 * [BEGIN_COT_EXT]
 * Code=usercategories
 * Name=User Categories
 * Category=community-social
 * Description=Add custom categories for users
 * Version=3.6.27
 * Date=Jan 30th, 2026
 * Author=CMSWorks Team, Cotonti Team, adapted webitproff, 2026 | https://github.com/webitproff
 * Copyright=Copyright (c) CMSWorks.ru, littledev.ru, Cotonti Team, adapted webitproff, 2026
 * Auth_guests=R
 * Lock_guests=W12345A
 * Auth_members=RW
 * Lock_members=12345A
 * [END_COT_EXT]
 * 
 * [BEGIN_COT_EXT_CONFIG]
 * catslimit=01:textarea:::Лимит категорий для выбора
 * [END_COT_EXT_CONFIG]
 * 
 * [BEGIN_COT_EXT_CONFIG_STRUCTURE]
 * keywords=01:string:::
 * metatitle=02:string:::
 * metadesc=03:string:::
 * [END_COT_EXT_CONFIG_STRUCTURE]
 */

/**
 * Filename: usercategories.setup.php
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