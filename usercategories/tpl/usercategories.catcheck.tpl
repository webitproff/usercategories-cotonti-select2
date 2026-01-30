<!-- BEGIN: MAIN -->
<!-- IF {CAT_LEVEL} == 1 -->
<script src="{PHP.cfg.plugins_dir}/usercategories/js/usercategories.js" type="text/javascript"></script>	
<!-- ENDIF -->
<ul<!-- IF {CAT_LEVEL} == 1 --> id="ucats_check" class="nav nav-list"<!-- ENDIF -->>
	<!-- BEGIN: CAT_ROW -->
	<li>{CAT_ROW_CHECKBOX}
		<!-- IF {CAT_ROW_SUBCAT} -->
		{CAT_ROW_SUBCAT}
		<!-- ENDIF -->
	</li>
	<!-- END: CAT_ROW -->
</ul>
<!-- END: MAIN -->
/**
 * Filename: usercategories.catcheck.tpl
 * User Categories plugin for Cotonti 0.9.26, PHP 8.4+
 * Version: 3.6.27
 * Date: Jan 30th, 2026
 * Adaptation: webitproff, 2026 | https://github.com/webitproff 
 * @package usercategories
 * @author CMSWorks Team
 * @copyright Copyright (c) CMSWorks.ru, littledev.ru, Cotonti Team
 * @license BSD
 */
 