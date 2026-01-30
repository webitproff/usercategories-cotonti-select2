<?php
/**
 * Installation handler for usercategories plugin
 *
 * Adds all freelance-related categories to cot_structure with automatic rights inheritance
 *
 * @package usercategories
 */

/**
 * Filename: usercategories.install.php
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

require_once cot_incfile('usercategories', 'plug');
require_once cot_incfile('structure');

$categories = [
    ['code' => 'site-administration',           'title' => 'Администрирование сайтов',         'desc' => 'Управление и поддержка веб-сайтов.', 'path' => '001'],
    ['code' => 'site-content',                  'title' => 'Наполнение сайтов товарами',       'desc' => 'Добавление и редактирование контента на сайтах.', 'path' => '001.001'],
    ['code' => 'system-admin',                  'title' => 'Системное администрирование',     'desc' => 'Настройка серверов, хостинга и систем сайтов.', 'path' => '001.002'],
    ['code' => 'support',                       'title' => 'Служба поддержки',                'desc' => 'Техническая поддержка пользователей сайтов.', 'path' => '001.003'],

    ['code' => 'architecture-engineering',      'title' => 'Архитектура и Инжиниринг',       'desc' => 'Проектирование зданий и конструкций.', 'path' => '002'],
    ['code' => 'interior-exterior',             'title' => 'Интерьеры и Экстерьеры',          'desc' => 'Дизайн интерьеров и экстерьеров.', 'path' => '002.001'],
    ['code' => 'landscape-design',              'title' => 'Ландшафтный дизайн',              'desc' => 'Проектирование садов и ландшафтов.', 'path' => '002.002'],
    ['code' => 'blueprints-diagrams',           'title' => 'Чертежи и Схемы',                 'desc' => 'Создание архитектурных чертежей и схем.', 'path' => '002.003'],

    ['code' => 'audio-video',                    'title' => 'Аудио и Видео',                   'desc' => 'Создание и монтаж аудио и видеоматериалов.', 'path' => '003'],
    ['code' => 'animation',                      'title' => 'Анимация',                        'desc' => 'Создание анимационных роликов.', 'path' => '003.001'],
    ['code' => 'audio-editing',                  'title' => 'Аудиомонтаж',                     'desc' => 'Монтаж и обработка аудио.', 'path' => '003.002'],
    ['code' => 'video-editing',                  'title' => 'Видеомонтаж',                     'desc' => 'Монтаж и обработка видео.', 'path' => '003.003'],
    ['code' => 'music-sounds',                   'title' => 'Музыка и Звуки',                  'desc' => 'Создание музыкальных и звуковых эффектов.', 'path' => '003.004'],
    ['code' => 'voice-over',                     'title' => 'Озвучивание',                     'desc' => 'Запись и озвучивание текстов.', 'path' => '003.005'],
    ['code' => 'presentations',                  'title' => 'Презентации',                     'desc' => 'Создание презентаций и слайдов.', 'path' => '003.006'],

    ['code' => 'web-design',                     'title' => 'Веб-дизайн и Интерфейсы',         'desc' => 'Создание веб-дизайнов и интерфейсов.', 'path' => '004'],
    ['code' => 'banners',                        'title' => 'Баннеры',                         'desc' => 'Создание рекламных и графических баннеров.', 'path' => '004.001'],
    ['code' => 'ui-ux-design',                   'title' => 'Дизайн интерфейсов и игр',        'desc' => 'Проектирование интерфейсов и игровых экранов.', 'path' => '004.002'],
    ['code' => 'mobile-design',                  'title' => 'Дизайн мобильных приложений',     'desc' => 'Создание UI для мобильных приложений.', 'path' => '004.003'],
    ['code' => 'website-design',                 'title' => 'Дизайн сайтов',                   'desc' => 'Веб-дизайн сайтов и лендингов.', 'path' => '004.004'],

    ['code' => 'websites',                        'title' => 'Веб-сайты',                        'desc' => 'Разработка и сопровождение веб-сайтов.', 'path' => '005'],
    ['code' => 'html-layout',                     'title' => 'HTML-верстка',                      'desc' => 'Создание HTML-страниц и шаблонов.', 'path' => '005.001'],
    ['code' => 'web-programming',                'title' => 'Веб-программирование',              'desc' => 'Программирование веб-приложений.', 'path' => '005.002'],
    ['code' => 'online-stores',                  'title' => 'Интернет-магазины',                  'desc' => 'Создание и настройка интернет-магазинов.', 'path' => '005.003'],
    ['code' => 'turnkey-sites',                  'title' => 'Сайты «под ключ»',                  'desc' => 'Разработка готовых сайтов «под ключ».', 'path' => '005.004'],
    ['code' => 'website-testing',                'title' => 'Тестирование сайтов',               'desc' => 'Тестирование функционала и дизайна сайтов.', 'path' => '005.005'],

    ['code' => 'graphics-photography',           'title' => 'Графика и Фотография',            'desc' => 'Создание графики и обработка фото.', 'path' => '006'],
    ['code' => '3d-graphics',                    'title' => '3D-графика',                       'desc' => 'Создание трёхмерной графики.', 'path' => '006.001'],
    ['code' => 'illustrations',                  'title' => 'Иллюстрации и Рисунки',            'desc' => 'Рисунки, иллюстрации и комиксы.', 'path' => '006.002'],
    ['code' => 'photo-editing',                  'title' => 'Обработка фотографий',             'desc' => 'Редактирование и ретушь фотографий.', 'path' => '006.003'],

    ['code' => 'printing-identity',              'title' => 'Полиграфия и Айдентика',          'desc' => 'Дизайн и подготовка печатной продукции.', 'path' => '007'],
    ['code' => 'print-layout',                   'title' => 'Верстка полиграфии',              'desc' => 'Подготовка макетов для печати.', 'path' => '007.001'],
    ['code' => 'product-design',                 'title' => 'Дизайн продукции',                 'desc' => 'Дизайн упаковки и товаров.', 'path' => '007.002'],
    ['code' => 'logos-signs',                    'title' => 'Логотипы и Знаки',                 'desc' => 'Создание логотипов и фирменных знаков.', 'path' => '007.003'],
    ['code' => 'corporate-style',                'title' => 'Фирменный стиль',                  'desc' => 'Разработка корпоративного стиля.', 'path' => '007.004'],

    ['code' => 'software-programming',           'title' => 'Программирование ПО',              'desc' => 'Разработка программного обеспечения.', 'path' => '008'],
    ['code' => '1c-programming',                 'title' => '1С-программирование',              'desc' => 'Разработка решений на платформе 1С.', 'path' => '008.001'],
    ['code' => 'databases',                      'title' => 'Базы данных',                      'desc' => 'Проектирование и работа с БД.', 'path' => '008.002'],
    ['code' => 'mobile-apps',                    'title' => 'Мобильные приложения',             'desc' => 'Разработка мобильных приложений.', 'path' => '008.003'],
    ['code' => 'custom-software',                'title' => 'Прикладное ПО',                     'desc' => 'Создание программ под конкретные задачи.', 'path' => '008.004'],
    ['code' => 'game-dev',                       'title' => 'Разработка игр',                    'desc' => 'Создание игр для ПК и мобильных устройств.', 'path' => '008.005'],
    ['code' => 'system-software',                'title' => 'Системное программирование',       'desc' => 'Разработка системного ПО и драйверов.', 'path' => '008.006'],
    ['code' => 'software-testing',               'title' => 'Тестирование ПО',                  'desc' => 'Тестирование и отладка программного обеспечения.', 'path' => '008.007'],

    ['code' => 'seo',                            'title' => 'Продвижение сайтов (SEO)',         'desc' => 'Оптимизация и продвижение сайтов.', 'path' => '009'],
    ['code' => 'context-ad',                      'title' => 'Контекстная реклама',              'desc' => 'Настройка и управление рекламой.', 'path' => '009.001'],
    ['code' => 'marketing-analysis',             'title' => 'Маркетинговый анализ',             'desc' => 'Анализ рынка и конкурентов.', 'path' => '009.002'],
    ['code' => 'seo-systems',                    'title' => 'Поисковые системы (SEO)',          'desc' => 'Оптимизация сайтов для поисковых систем.', 'path' => '009.003'],
    ['code' => 'social-media',                   'title' => 'Социальные сети (SMM и SMO)',     'desc' => 'Продвижение в социальных сетях.', 'path' => '009.004'],

    ['code' => 'texts-translations',             'title' => 'Тексты и Переводы',               'desc' => 'Создание и редактирование текстов.', 'path' => '010'],
    ['code' => 'copywriting',                     'title' => 'Копирайтинг',                     'desc' => 'Написание рекламных и продающих текстов.', 'path' => '010.001'],
    ['code' => 'translations',                    'title' => 'Переводы',                         'desc' => 'Перевод текстов на разные языки.', 'path' => '010.002'],
    ['code' => 'editing-proofreading',            'title' => 'Редактирование и Корректура',     'desc' => 'Проверка и правка текстов.', 'path' => '010.003'],
    ['code' => 'transcription',                   'title' => 'Транскрибация',                    'desc' => 'Преобразование аудио и видео в текст.', 'path' => '010.004'],

    ['code' => 'management',                      'title' => 'Управление и Менеджмент',          'desc' => 'Руководство проектами и командами.', 'path' => '011'],
    ['code' => 'sales-leads',                     'title' => 'Продажи и лиды',                   'desc' => 'Продажа товаров и генерация лидов.', 'path' => '011.001'],
    ['code' => 'project-management',             'title' => 'Управление проектами',             'desc' => 'Планирование и контроль проектов.', 'path' => '011.002'],

    ['code' => 'education-tutoring',             'title' => 'Учеба и Репетиторство',           'desc' => 'Помощь в обучении и подготовка работ.', 'path' => '012'],
    ['code' => 'papers-assistance',               'title' => 'Рефераты, Курсовые и Дипломы',    'desc' => 'Помощь с написанием учебных работ.', 'path' => '012.001'],
];

foreach ($categories as $cat) {
    cot_structure_add('usercategories', [
        'structure_area'   => 'usercategories',
        'structure_code'   => $cat['code'],
        'structure_title'  => $cat['title'],
        'structure_desc'   => $cat['desc'],
        'structure_path'   => $cat['path'],
        'structure_locked' => 0,
        'structure_count'  => 0,
        'structure_tpl'    => '',
        'structure_icon'   => ''
    ]);
}

global $db_users;
if (!Cot::$db->fieldExists($db_users, "user_cats")) {
    Cot::$db->query(
        'ALTER TABLE ' . Cot::$db->users . ' ADD COLUMN user_cats TEXT NULL DEFAULT NULL'
    );
}
?>
