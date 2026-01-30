<div class="offcanvas offcanvas-start" tabindex="-1" id="treecatsUserCatsLeftOffcanvas" aria-labelledby="treecatsUserCatsLeftOffcanvasLabel">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="treecatsUserCatsLeftOffcanvasLabel">
            <span class="me-2">
				<i class="fa-solid fa-list"></i>
			</span>{PHP.L.usercategories_tree_title}
		</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body">
		{PHP|cot_usercategories_tree('', '')}
	</div>
	<div class="offcanvas-footer">
		<div class="alert alert-info">
		для того, чтобы раскрывались списки требуется подключение функции <a href="https://abuyfile.com/ru/forums/cotonti/custom/functions-custom/topic53">cot_load_structure_custom()</a>
		</div>
	</div>
</div>