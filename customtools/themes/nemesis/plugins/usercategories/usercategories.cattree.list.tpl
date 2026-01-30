<!-- BEGIN: MAIN -->
<!-- Список категорий; если уровень 0, добавляем id и классы Bootstrap для вертикальной навигации -->
<ul<!-- IF {CAT_LEVEL} == 0 --> id="ucats_list" class="list-group list-group-flush"<!-- ENDIF -->>
    <!-- BEGIN: CAT_ROW -->
    <!-- Если категория выбрана, выводим её -->
    <!-- IF {CAT_ROW_SELECTED} -->
    <li class="list-group-item bg-transparent"> 
        <!-- Заголовок категории с классом nav-link; добавляем active, если категория выбрана -->
        <span class="nav-link<!-- IF {CAT_ROW_SELECTED} --> active<!-- ENDIF -->">{CAT_ROW_TITLE}</span>
        <!-- Если есть подкатегории, выводим их -->
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