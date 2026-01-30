<?php
// отсюда себе копируем только function cot_load_structure_custom() но только если ее у вас нет!!! 
// остальные опциональные
defined('COT_CODE') or die('Wrong URL');


// Определение глобальных переменных для работы с базой данных, конфигурацией и структурой
global $db, $db_structure, $cfg, $cot_extrafields;
// Объявление глобальной переменной структуры
global $structure;

/**
 * Загружает структуру категорий из базы данных с учетом иерархии и дополнительных полей
 *
 * @return void
 */
function cot_load_structure_custom()
{
    // Доступ к глобальным переменным
    global $db, $db_structure, $cfg, $cot_extrafields, $structure;
    // Инициализация массива структуры
    $structure = [];
    // Инициализация массива подкатегорий
    $subcats = [];

    // Выбор SQL-запроса в зависимости от режима обновления
    if (defined('COT_UPGRADE')) {
        // Запрос для режима обновления, сортировка только по пути
        $sql = $db->query("SELECT * FROM $db_structure ORDER BY COALESCE(structure_path, '') ASC");
    } else {
        // Запрос для обычного режима, сортировка по области и пути
        $sql = $db->query("SELECT * FROM $db_structure ORDER BY structure_area ASC, COALESCE(structure_path, '') ASC");
    }

    // Инициализация массивов для путей, текстовых путей и шаблонов
    $path = [];
    $tpath = [];
    $tpls = [];

    // Обработка каждой записи из результата запроса
    foreach ($sql->fetchAll() as $row) {
        // Пропуск записей с пустым или нестроковым кодом или областью
        if (empty($row['structure_code']) || !is_string($row['structure_code']) || empty($row['structure_area']) || !is_string($row['structure_area'])) {
            continue;
        }

        // Присваивание кода категории
        $row['structure_code'] = $row['structure_code'];
        // Установка пути категории, если не указан — использование кода
        $row['structure_path'] = !empty($row['structure_path']) && is_string($row['structure_path']) ? $row['structure_path'] : $row['structure_code'];
        // Присваивание области категории
        $row['structure_area'] = $row['structure_area'];
        // Установка заголовка, если не указан — пустая строка
        $row['structure_title'] = !empty($row['structure_title']) && is_string($row['structure_title']) ? $row['structure_title'] : '';
        // Установка описания, если не указано — пустая строка
        $row['structure_desc'] = !empty($row['structure_desc']) && is_string($row['structure_desc']) ? $row['structure_desc'] : '';
        // Установка иконки, если не указана — пустая строка
        $row['structure_icon'] = !empty($row['structure_icon']) && is_string($row['structure_icon']) ? $row['structure_icon'] : '';
        // Приведение флага блокировки к целому числу
        $row['structure_locked'] = isset($row['structure_locked']) ? (int)$row['structure_locked'] : 0;
        // Приведение счетчика к целому числу
        $row['structure_count'] = isset($row['structure_count']) ? (int)$row['structure_count'] : 0;
        // Установка шаблона, если не указан — использование кода
        $row['structure_tpl'] = !empty($row['structure_tpl']) && is_string($row['structure_tpl']) ? $row['structure_tpl'] : $row['structure_code'];
        // Приведение идентификатора к целому числу
        $row['structure_id'] = isset($row['structure_id']) ? (int)$row['structure_id'] : 0;

        // Поиск последней точки в пути
        $last_dot = mb_strrpos($row['structure_path'], '.');

        // Обработка иерархического пути
        if ($last_dot !== false) {
            // Извлечение родительского пути
            $path1 = mb_substr($row['structure_path'], 0, $last_dot);
            // Формирование полного пути
            $path[$row['structure_path']] = !empty($path[$path1]) ? $path[$path1] . '.' . $row['structure_code'] : $row['structure_code'];
            // Определение разделителя для текстового пути
            $separator = (strip_tags($cfg['separator']) === $cfg['separator']) ? ' ' . $cfg['separator'] . ' ' : ' \ ';
            // Формирование текстового пути
            $tpath[$row['structure_path']] = !empty($tpath[$path1]) ? $tpath[$path1] . $separator . $row['structure_title'] : $row['structure_title'];
            // Определение родительской категории
            $parent_dot = mb_strrpos($path[$path1] ?? '', '.');
            $parent = ($parent_dot !== false) ? mb_substr($path[$path1], $parent_dot + 1) : ($path[$path1] ?? $row['structure_code']);
            // Добавление кода категории в массив подкатегорий
            $subcats[$row['structure_area']][$parent][] = $row['structure_code'];
        } else {
            // Установка пути для корневой категории
            $path[$row['structure_path']] = $row['structure_code'];
            // Установка текстового пути для корневой категории
            $tpath[$row['structure_path']] = $row['structure_title'];
            // Установка родительской категории
            $parent = $row['structure_code'];
        }

        // Обработка шаблона, если указано 'same_as_parent'
        if ($row['structure_tpl'] === 'same_as_parent') {
            // Использование шаблона родителя или кода категории
            $row['structure_tpl'] = $tpls[$parent] ?? $row['structure_code'];
        }

        // Сохранение шаблона для категории
        $tpls[$row['structure_code']] = $row['structure_tpl'];

        // Формирование структуры данных категории
        $structure[$row['structure_area']][$row['structure_code']] = [
            // Путь категории
            'path' => $path[$row['structure_path']],
            // Текстовый путь категории
            'tpath' => $tpath[$row['structure_path']],
            // Исходный путь категории
            'rpath' => $row['structure_path'],
            // Идентификатор категории
            'id' => $row['structure_id'],
            // Шаблон категории
            'tpl' => $row['structure_tpl'],
            // Заголовок категории
            'title' => $row['structure_title'],
            // Описание категории
            'desc' => $row['structure_desc'],
            // Иконка категории
            'icon' => $row['structure_icon'],
            // Флаг блокировки
            'locked' => $row['structure_locked'],
            // Счетчик элементов
            'count' => $row['structure_count'],
            // Подкатегории
            'subcats' => $subcats[$row['structure_area']][$row['structure_code']] ?? []
        ];

        // Обработка дополнительных полей, если они существуют
        if (!empty($cot_extrafields[$db_structure])) {
            // Перебор дополнительных полей
            foreach ($cot_extrafields[$db_structure] as $exfld) {
                // Формирование имени поля
                $fieldName = 'structure_' . $exfld['field_name'];
                // Добавление значения дополнительного поля в структуру
                $structure[$row['structure_area']][$row['structure_code']][$exfld['field_name']] = $row[$fieldName] ?? null;
            }
        }
    }

    // Финальная проверка и фильтрация структуры
    foreach ($structure as $area => &$area_structure) {
        // Проверка, что структура области является массивом
        if (!is_array($area_structure)) {
            // Инициализация пустого массива для невалидной области
            $area_structure = [];
            continue;
        }
        // Проверка каждой записи в области
        foreach ($area_structure as $i => &$x) {
            // Пропуск невалидных записей
            if (!is_array($x) || empty($x['path']) || !is_string($x['path'])) {
                unset($area_structure[$i]);
                continue;
            }
            // Установка подкатегорий
            $x['subcats'] = $subcats[$area][$i] ?? [];
            // Присваивание пути
            $x['path'] = $x['path'];
            // Установка текстового пути, если не указан — использование кода
            $x['tpath'] = !empty($x['tpath']) && is_string($x['tpath']) ? $x['tpath'] : $i;
            // Установка исходного пути, если не указан — использование кода
            $x['rpath'] = !empty($x['rpath']) && is_string($x['rpath']) ? $x['rpath'] : $i;
            // Установка заголовка, если не указан — пустая строка
            $x['title'] = !empty($x['title']) && is_string($x['title']) ? $x['title'] : '';
            // Установка описания, если не указано — пустая строка
            $x['desc'] = !empty($x['desc']) && is_string($x['desc']) ? $x['desc'] : '';
            // Установка иконки, если не указана — пустая строка
            $x['icon'] = !empty($x['icon']) && is_string($x['icon']) ? $x['icon'] : '';
            // Приведение счетчика к целому числу
            $x['count'] = isset($x['count']) ? (int)$x['count'] : 0;
            // Приведение флага блокировки к целому числу
            $x['locked'] = isset($x['locked']) ? (int)$x['locked'] : 0;
            // Установка шаблона, если не указан — использование кода
            $x['tpl'] = !empty($x['tpl']) && is_string($x['tpl']) ? $x['tpl'] : $i;
            // Приведение идентификатора к целому числу
            $x['id'] = isset($x['id']) ? (int)$x['id'] : 0;
        }
        // Освобождение ссылки на последнюю запись
        unset($x);
    }
    // Освобождение ссылки на последнюю область
    unset($area_structure);

    // Сохранение копии структуры перед выполнением плагинов
    $temp_structure = $structure;
    // Выполнение плагинов, подключенных к событию structure
    foreach (cot_getextplugins('structure') as $pl) {
        // Восстановление структуры перед выполнением плагина
        $structure = $temp_structure;
        // Подключение файла плагина
        include $pl;
        // Проверка структуры после выполнения плагина
        foreach ($structure as $area => &$area_structure) {
            // Проверка, что структура области является массивом
            if (!is_array($area_structure)) {
                // Инициализация пустого массива для невалидной области
                $area_structure = [];
                continue;
            }
            // Проверка каждой записи в области
            foreach ($area_structure as $i => &$x) {
                // Пропуск невалидных записей
                if (!is_array($x) || empty($x['path']) || !is_string($x['path'])) {
                    unset($area_structure[$i]);
                    continue;
                }
            }
            // Освобождение ссылки на последнюю запись
            unset($x);
        }
        // Освобождение ссылки на последнюю область
        unset($area_structure);
    }
    // Финальное восстановление структуры
    $structure = $temp_structure;
}

function forums_url_structure(&$args)
{
    global $cfg, $db, $structure, $db_forum_topics, $db_forum_posts;

    require_once cot_incfile('forums', 'module');

    $script = 'forums';
    $replacement = '';

    if (isset($args['m']) && $args['m'] === 'topics') {
        if (isset($args['s'])) {
            $d = isset($args['d']) ? (int) $args['d'] : 0;
            $replacement .= str_replace('.', '/', $structure['forums'][$args['s']]['path'] ?? '');

            if (isset($args['d'])) {
                $replacement .= '/page' . $d;
            }

            unset($args['d'], $args['s']);
        } else {
            $replacement .= $script;
        }
    } elseif (isset($args['m']) && $args['m'] === 'posts') {
        if (isset($args['q'])) {
            $q = (int) $args['q'];
            $d = isset($args['d']) ? (int) $args['d'] : 0;
            $s = $db->query("SELECT fp_cat FROM $db_forum_posts WHERE fp_topicid = $q")->fetchColumn();

            if ($s !== false) {
                $replacement .= str_replace('.', '/', $structure['forums'][$s]['path'] ?? '') . '/topic' . $q;
            } else {
                $replacement .= $script;
            }

            if (isset($args['d'])) {
                $replacement .= '/page' . $d;
            }

            unset($args['d'], $args['q'], $args['m']);
        } elseif (isset($args['id'])) {
            $id = (int) $args['id'];
            $s = $db->query("SELECT fp_cat FROM $db_forum_posts WHERE fp_id = $id")->fetchColumn();

            if ($s !== false) {
                $replacement .= str_replace('.', '/', $structure['forums'][$s]['path'] ?? '') . '/post' . $id;
            } else {
                $replacement .= $script;
            }

            unset($args['id'], $args['m']);
        } else {
            $replacement .= $script;
        }
    } else {
        $replacement .= $script;
    }

    return $replacement;
}



/**
 * Получает данные пользователя-владельца страницы.
 *
 * Эта функция определяет владельца страницы на основе параметров 'id' или 'u' из URL.
 * Если параметры отсутствуют, она использует ID текущего авторизованного пользователя.
 *
 * @return array|null Массив данных пользователя или null, если пользователь не найден.
 */
function cot_getUserDataOwner()
{
    // Импортируем из GET-параметра 'id' число (INT), это ID пользователя
    $id = cot_import('id', 'G', 'INT');
    // Импортируем из GET-параметра 'u' строку (TXT), это username пользователя
    $u = cot_import('u', 'G', 'TXT');

    // Если передан username, но не передан id
    if (!empty($u) && empty($id)) {
        // Выполняем запрос в БД: выбираем user_id из таблицы пользователей, где user_name совпадает с $u
        $id = Cot::$db->query(
            'SELECT user_id FROM ' . Cot::$db->users . ' WHERE user_name = ? LIMIT 1',
            [$u]
        )->fetchColumn();
    }
    // Если не передан ни id, ни username, но текущий юзер авторизован
    elseif (empty($id) && empty($u) && Cot::$usr['id'] > 0) {
        // Тогда используем id текущего авторизованного пользователя
        $id = Cot::$usr['id'];
    }

    // Проверяем существование пользователя в БД по полученному id и возвращаем его данные
    if ($id > 0) {
        return Cot::$db->query(
            'SELECT * FROM ' . Cot::$db->users . ' WHERE user_id = ? LIMIT 1',
            [$id]
        )->fetch();
    }

    return null;
}

/**
 * Проверяет, является ли текущий пользователь владельцем страницы.
 *
 * Эта функция использует cot_getUserDataOwner() для получения данных владельца
 * и сравнивает его ID с ID текущего авторизованного пользователя.
 *
 * @return bool True, если текущий пользователь — владелец страницы, иначе False.
 */
function cot_isOwner()
{
    // Получаем данные владельца страницы с помощью вспомогательной функции
    $ownerData = cot_getUserDataOwner();

    // Возвращаем true, если данные найдены и ID владельца совпадает с ID текущего пользователя
    if (!empty($ownerData) && Cot::$usr['id'] > 0 && Cot::$usr['id'] == $ownerData['user_id']) {
        return true;
    }

    // Если условия не выполнены, возвращаем false
    return false;
}

/**
 * Проверяет, является ли текущий пользователь автором топика.
 * <!-- IF {PHP|cot_isTopicAuthor()} -->
 * <b> Привет {PHP.usr.profile.user_name}, ты много пропустил</b>
 * <!-- ENDIF -->
 * Эта функция получает ID топика напрямую из URL и сравнивает user_id автора топика
 * с ID текущего авторизованного пользователя.
 *
 * @return bool True, если текущий пользователь — автор топика, иначе False.
 */
function cot_isTopicAuthor()
{
    // Объявляем глобальную переменную, содержащую имя таблицы форумов.
    global $db_forum_topics;

    // Импортируем ID топика напрямую из URL-параметра 'q'.
    // Это гарантирует, что мы всегда получаем правильное значение.
    $topicId = cot_import('q', 'G', 'INT');

    // Проверяем, авторизован ли пользователь, и передан ли ID топика.
    // Если нет, функция сразу возвращает false.
    if (!Cot::$usr || Cot::$usr['id'] <= 0 || empty($topicId)) {
        return false;
    }

    // Выполняем запрос в БД.
    // Используем $db_forum_topics для явного указания имени таблицы.
    // Это гарантирует, что запрос не будет содержать синтаксических ошибок.
    $posterId = Cot::$db->query(
        "SELECT ft_firstposterid FROM $db_forum_topics WHERE ft_id = ? LIMIT 1",
        [$topicId]
    )->fetchColumn();

    // Возвращаем true, если ID автора топика совпадает с ID текущего пользователя.
    if ($posterId > 0 && Cot::$usr['id'] == $posterId) {
        return true;
    }

    // Если условия не выполнены, возвращаем false.
    return false;
}

/**
 * Проверяет, является ли текущий пользователь автором статьи.
 * <!-- IF {PHP|cot_isPageAuthor()} -->
 * <b> Привет {PHP.usr.profile.user_name}, ты автор этой статьи.</b>
 * <!-- ENDIF -->
 * Эта функция получает ID статьи напрямую из URL и сравнивает user_id автора статьи
 * с ID текущего авторизованного пользователя.
 *
 * @return bool True, если текущий пользователь — автор статьи, иначе False.
 */
function cot_isPageAuthor()
{
    // Объявляем глобальную переменную, содержащую имя таблицы статей.
    global $db_pages;

    // Импортируем ID статьи напрямую из URL-параметра 'id'.
    $pageId = cot_import('id', 'G', 'INT');

    // Проверяем, авторизован ли пользователь, и передан ли ID статьи.
    if (!Cot::$usr || Cot::$usr['id'] <= 0 || empty($pageId)) {
        return false;
    }

    // Выполняем запрос к БД.
    $ownerId = Cot::$db->query(
        "SELECT page_ownerid FROM $db_pages WHERE page_id = ? LIMIT 1",
        [$pageId]
    )->fetchColumn();

    // Возвращаем true, если ID владельца статьи совпадает с ID текущего пользователя.
    if ($ownerId > 0 && Cot::$usr['id'] == $ownerId) {
        return true;
    }

    // Если условия не выполнены, возвращаем false.
    return false;
}
?>