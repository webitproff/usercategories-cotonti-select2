<!-- BEGIN: MAIN -->

<!-- подключаем Offcanvas (меню выезжающее с боку)  -->
<!-- в нем лежит шаблон с функцией cot_usercategories_tree, она же равно тег в фигурных скобках USERCATEGORIES_CATALOG  -->
<!-- эта функция подключает шаблон usercategories.cattree.tpl -->
<!-- смотрите папку "customtools"  -->

{FILE "{PHP.cfg.themes_dir}/{PHP.cfg.defaulttheme}/inc/header/treecatsUserCatsLeftOffcanvas.tpl"}
<div class="border-bottom border-secondary py-3 px-3">
    <div class="d-flex align-items-center g-0">
        <div class="d-flex justify-content-center pe-2">
            <a type="button"
			data-bs-toggle="offcanvas"
			data-bs-target="#treecatsUserCatsLeftOffcanvas"
			aria-controls="treecatsUserCatsLeftOffcanvas"
			data-bs-toggle="tooltip"
			title="{PHP.L.usercategories_tree_title}">
                Categories <i class="fa-solid fa-square-caret-right fa-2xl" style="color:#ff8000;"></i>
			</a>
		</div>
        <div class="flex-grow-1">
            <nav aria-label="breadcrumb">
                <div class="ps-container-breadcrumb">
                    <ol class="breadcrumb d-flex mb-0">
						<li class="breadcrumb-item">
							<a href="{PHP.cfg.mainurl}">{PHP.L.Home}</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{PHP.cot_groups.4.alias|cot_url('users', 'group=$this')}">
								{PHP.cot_groups.4.name}
							</a>
						</li>
						
					</ol>
				</div>
			</nav>
		</div>
	</div>
</div>
<div class="min-vh-50 px-2 pb-4">
	<div class="px-0 m-0 row justify-content-center">
		<div class="col-12 py-4">
			<!-- Название и описание категории -->
			<!-- IF {PHP|cot_plugin_active('usercategories')} AND {USERS_CHOSEN_CATEGORY} -->
			{USERS_CHOSEN_CATEGORY}
			<!-- ENDIF -->
			
			<!-- Блок фильтров -->
			<div class="p-3 mb-4 rounded-2" style="border: 5px var(--bs-dark-border-subtle) solid">
				<form action="{USERS_FILTERS_ACTION}" method="GET" class="d-flex flex-column gap-3"> 
					
					<!-- IF {USERS_FILTERS_PARAMS} -->
					{USERS_FILTERS_PARAMS}
					<!-- ENDIF -->
					
					<!-- НЕ УДАЛЯТЬ ТЕГ "USERS_FILTERS_PARAMS" -->
					<!-- смотреть строку 460 в users.main.php -->
					<!-- $filtersFormParams = ''; -->
					<!-- 'USERS_FILTERS_PARAMS' => $filtersFormParams, -->
					
					<!-- Поле поиска -->
					<div class="row align-items-center">
						<label class="col-12 col-sm-3 mb-2 mb-sm-0">{PHP.L.Search}:</label>
						<div class="col-12 col-sm-9"> {USERS_FILTERS_SEARCH} </div>
					</div>
					<!-- Поле категории -->
					<!-- IF {PHP|cot_plugin_active('usercategories')} -->
					<div class="row align-items-center">
						<label class="col-12 col-sm-3 mb-2 mb-sm-0">{PHP.L.Category}:</label>
						<div class="col-12 col-sm-9">{USERCATEGORIES_SEARCH_CAT}</div>
					</div>
					<!-- ENDIF -->
					
					<!-- Кнопка отправки -->
					<div class="row">
						<div class="col-12 col-sm-3 d-none d-sm-block"></div>
						<div class="col-12 col-sm-9">
							<div class="row g-3 justify-content-md-end justify-content-center">
								<div class="col-md-6 col-12 text-center">
									<button type="submit" class="w-100 w-md-auto btn btn-outline-primary">{PHP.L.Search}</button>
								</div>
								<div class="col-md-6 col-12 text-center">
									<a class="btn btn-outline-danger w-100 " href="{PHP.cot_groups.4.alias|cot_url('users', 'group=$this')}">{PHP.L.Reset}</a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- BEGIN: USERS_ROW -->
			<div class="row card mx-1 align-items-center mb-3">
				<div class="card-body shadow rounded">
					<div class="row">
						<!-- Аватар -->
						<div class="col-12 col-lg-2 text-center text-lg-start">
							<!-- IF {PHP|cot_plugin_active('userimages')} -->
							<!-- IF {USERS_ROW_AVATAR_SRC} -->
							<a href="{USERS_ROW_DETAILS_URL}">
								<img src="{USERS_ROW_AVATAR_SRC}" alt="{USERS_ROW_NICKNAME}" class="rounded" width="75" height="75">
							</a>
							<!-- ELSE -->
							<a href="{USERS_ROW_DETAILS_URL}">
								<img src="{PHP.R.userimg_default_avatar}" alt="{USERS_ROW_NICKNAME}" class="rounded" width="75" height="75">
							</a>
							<!-- ENDIF -->
							<!-- ENDIF -->
							<!-- IF {PHP.usr.maingrp} == 5 -->
							<p class="mb-0">
								<a class="text-danger fw-semibold" href="{USERS_ROW_ID|cot_url('users','m=edit&id=$this')}">{PHP.L.Edit}</a>
							</p>
							<!-- ENDIF -->
						</div>
						<!-- Информация -->
						<div class="col-12 col-lg-10">
							<h5 class="mb-0 fs-6 fw-semibold text-primary-emphasis">
								<a class="text-reset" href="{USERS_ROW_DETAILS_URL}">{USERS_ROW_FULL_NAME}</a>
								<!-- IF {USERS_ROW_FOLIO_COUNT} -->
								<span class="badge text-bg-warning">{USERS_ROW_FOLIO_COUNT}</span>
								<!-- ENDIF -->
							</h5>
							<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
								<div>
									<h4 class="h5 text-success-emphasis mb-0">{USERS_ROW_MAIN_SKILLS} {USERS_ROW_USERPOINTS}</h4>
									<!-- IF {USERS_ROW_ISPRO} -->
									<span class="badge bg-danger ms-2">PRO</span>
									<!-- ENDIF -->
									<!-- IF {PHP.urr.user_country} != '00' -->
									<p class="mb-0">{USERS_ROW_COUNTRY}</p>
									<!-- ENDIF -->
									<!-- IF {PHP|cot_plugin_active('usercategories')} AND {USERS_ROW_CATS} -->
									<p class="mb-0">{USERS_ROW_CATS|cot_usercategories_tree($this, '', 'listlev1')}</p>
									<!-- ENDIF -->
								</div>
							</div>
						</div>
					</div>
					<!-- IF {PHP|cot_plugin_active('reviews')} -->
					<div class="col-12 text-center text-lg-start">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="review-stars">
									<span class="ms-3">{USERS_ROW_REVIEWS_AVG_STARS_HTML}</span>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div>
									<span class="ms-3">{PHP.L.reviews_reviews}: {USERS_ROW_REVIEWS_TOTAL_COUNT} | {PHP.L.2wd_users_avr_reviews} {USERS_ROW_REVIEWS_AVG_STARS}/5</span>
								</div>
							</div>
						</div>
					</div>
					<!-- ENDIF -->
				</div>
			</div>
			<!-- END: USERS_ROW -->
			<!-- Пагинация -->
			<div class="row">
				<div class="col-12">
					<div class="row align-items-center mb-4">
						<!-- Информация о пользователях -->
						<div class="col-12 col-md-6">
							<div>
								<span>{PHP.L.users_usersperpage}: {ENTRIES_PER_PAGE}</span>
								<span class="ms-3">{PHP.L.users_usersinthissection}: {TOTAL_ENTRIES}</span>
							</div>
						</div>
						<!-- Пагинация -->
						<div class="col-12 col-md-6">
							<nav aria-label="Users pagination" class="d-flex justify-content-md-end">
								<ul class="pagination mb-0"> {PREVIOUS_PAGE} {PAGINATION} {NEXT_PAGE} </ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: MAIN -->