<!-- BEGIN: MAIN -->
<ul<!-- IF {CAT_LEVEL} == 1 --> id="ucats_tree" class="nav nav-list"<!-- ENDIF -->>
	<!-- IF {CAT_LEVEL} == 1 -->
	<li><a href="{CAT_URL}">{PHP.L.All}</a></li>		
	<!-- ENDIF -->
	<!-- BEGIN: CAT_ROW -->
	<li<!-- IF {CAT_ROW_SELECTED} --> class="active"<!-- ENDIF -->><a href="{CAT_ROW_URL}">{CAT_ROW_TITLE} ({CAT_ROW_COUNT})</a>
		<!-- IF {CAT_ROW_SUBCAT} -->
		{CAT_ROW_SUBCAT}
		<!-- ENDIF -->
	</li>
	<!-- END: CAT_ROW -->
</ul>
<!-- END: MAIN -->
/**
 * Filename: usercategories.cattree.tpl
 * User Categories plugin for Cotonti 0.9.26, PHP 8.4+
 * Version: 3.6.27
 * Date: Jan 30th, 2026
 * Adaptation: webitproff, 2026 | https://github.com/webitproff 
 * @package usercategories
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks.ru, littledev.ru, Cotonti Team
 * @license BSD
 */