<!-- BEGIN: MAIN -->
<ul<!-- IF {CAT_LEVEL} == 0 --> id="ucats_list" class="nav nav-list"<!-- ENDIF -->>
	<!-- BEGIN: CAT_ROW -->
	<!-- IF {CAT_ROW_SELECTED} -->
	<li>{CAT_ROW_TITLE}
		<!-- IF {CAT_ROW_SUBCAT} -->
		{CAT_ROW_SUBCAT}
		<!-- ENDIF -->
	</li>
	<!-- ENDIF -->
	<!-- END: CAT_ROW -->
</ul>
<!-- END: MAIN -->
/**
 * Filename: usercategories.cattree.list.tpl
 * User Categories plugin for Cotonti 0.9.26, PHP 8.4+
 * Version: 3.6.27
 * Date: Jan 30th, 2026
 * Adaptation: webitproff, 2026 | https://github.com/webitproff 
 * @package usercategories
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks.ru, littledev.ru, Cotonti Team
 * @license BSD
 */