<!-- BEGIN: MAIN -->
<ul<!-- IF {CAT_LEVEL} == 0 --> class="nav flex-column"<!-- ELSE --> class="nav flex-column ps-3"<!-- ENDIF -->>
	<!-- IF {CAT_LEVEL} == 0 -->
	<li class="nav-item">
		<div class="mx-3"><i class="fa-regular fa-folder me-2"></i>
			<span><a href="{CAT_URL}">{PHP.L.All}</a></span>
		<span class="ms-auto">{CAT_COUNT}</span></div>
	</li>
	<hr class="my-2">
	<!-- ENDIF -->
	<!-- BEGIN: CAT_ROW -->
	<li class="nav-item">
		<!-- IF {CAT_ROW_SUBCAT} -->
		<div class="d-flex align-items-center">
			<!-- Полноценная ссылка на категорию (занимает всё пространство кроме стрелки) -->
			<a href="{CAT_ROW_URL}" class="nav-link flex-grow-1 d-flex align-items-center text-decoration-none text-reset<!-- IF {CAT_ROW_SELECTED} --> active<!-- ENDIF -->">
				<i class="fa-regular fa-folder me-2"></i>
				<span>{CAT_ROW_TITLE}</span>
				<span class="ms-auto">({CAT_ROW_COUNT})</span>
			</a>
			
			<!-- Стрелка — ТОЛЬКО toggle, НЕ ссылка -->
			<button type="button" class="btn btn-link text-reset px-2 py-0"
            data-bs-toggle="collapse"
            data-bs-target="#collapse-{CAT_ROW_ID}"
            aria-expanded="false"
            aria-controls="collapse-{CAT_ROW_ID}">
				<i class="fa fa-angle-down"></i> <
			</button>
		</div>
		
		<div class="collapse" id="collapse-{CAT_ROW_ID}">
			{CAT_ROW_SUBCAT}
		</div>
		<!-- ELSE -->
		<a href="{CAT_ROW_URL}" class="nav-link d-flex align-items-center<!-- IF {CAT_ROW_SELECTED} --> active<!-- ENDIF -->">
			<i class="fa-solid fa-file me-2"></i>
			<span>{CAT_ROW_TITLE}</span>
			<span class="ms-auto">({CAT_ROW_COUNT})</span>
		</a>
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