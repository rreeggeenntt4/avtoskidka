<?php
/**
 * @package avtoskidki
 */
/*
Plugin Name: Avtoskidki
Plugin URI: https://github.com/rreeggeenntt4
Description: Плагин добавляет возможность устанавливать скидки. Дополнение для темы car-rental.
Version: 1.0
Author: Автор решил не назваться
Author URI: https://github.com/rreeggeenntt4
License: GPLv2 or later
Text Domain: https://github.com/rreeggeenntt4
*/

/*
Данный плагин специально разработан для сайта https://github.com/rreeggeenntt4

Эта программа является свободным программным обеспечением; Вы можете 
изменить его в соответствии с условиями GNU General Public License.

Смотрите GNU General Public License для более подробной информации.
*/


/*Активация, деактивация, удаление плагина*/
register_activation_hook(__FILE__, 'avtoskidki_install');
register_deactivation_hook(__FILE__, 'avtoskidki_uninstall');
register_uninstall_hook(__FILE__, 'avtoskidki_delete');



/*Подключение файлов*/
require __DIR__ . '/avto_functions.php';
/*add_filter ('the_content','eco_otkrit_content');*/

/*Добавление скриптов, стилей, ajax*/
add_action('admin_enqueue_scripts', 'avtoskidki_scripts_style');
add_action('wp_enqueue_scripts', 'avtoskidki_scripts_style');

/*Работа с ajax*/
add_action('wp_ajax_new_avtoskidki', 'new_avtoskidki');
add_action('wp_ajax_avto_offer_delete', 'avto_offer_delete');

/*Добавление меню в админке*/
add_action('admin_menu', 'avtoskidki_add_menu');






?>