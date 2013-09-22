<?php
/*
Plugin Name: Simple Product Catalog
Plugin URI: https://github.com/ivannin/simple-product-catalog
Description: Каталог продуктов для Wordpress
Version: 0.1
Author: Иван Никитин
Author URI: http://ivannikitin.com
License:
	Copyright 2013  Ivan Nikitin  (email : ivan@nikitin.org)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
================================================================================
*/
// ------------------------- Параметры -------------------------
define('SPC_OPTION_PLUGIN_TITLE',		'spcPluginTitle');
define('SPC_OPTION_CAPTION_PRODUCT',	'spcCaptionProduct');
define('SPC_OPTION_CAPTION_PRODUCTS',	'spcCaptionProducts');
define('SPC_OPTION_USE_QUANTITY' ,		'spcUseQuantity');
define('SPC_OPTION_USE_IMAGE' ,			'spcUseImage');
define('SPC_OPTION_CURRENCY_SYMBOL',	'spcCurrencySymbol');
define('SPC_OPTION_SLUG_PRODUCT',		'spcSlugProduct');
define('SPC_OPTION_SLUG_SECTION',		'spcSlugSection');
define('SPC_OPTION_SLUG_STATUS',		'spcSlugStatus');

// ------------------------- Начальная инициализация -------------------------
add_action('plugins_loaded', 'spcInit');
function spcInit() 
{
	// Локализация
	load_plugin_textdomain('spc', false, basename(dirname(__FILE__)) . '/lang/');

	// Параметры плагина
	add_option(SPC_OPTION_PLUGIN_TITLE, __('Simple Product Catalog', 'spc'));	// Название в админке 
	add_option(SPC_OPTION_CAPTION_PRODUCT, __( 'Product', 'spc'));				// Название в единственном числе 
	add_option(SPC_OPTION_CAPTION_PRODUCTS, __( 'Products', 'spc'));			// Название во множественном числе 

	add_option(SPC_OPTION_USE_QUANTITY, TRUE);			// Использовать количество товаров в каталоге
	add_option(SPC_OPTION_USE_IMAGE, TRUE);				// Использовать изображения товаров в каталоге
	add_option(SPC_OPTION_CURRENCY_SYMBOL, '');			// Символ валюты
	add_option(SPC_OPTION_PRODUCT_SLUG, 'product');		// URL слаг продукта
	add_option(SPC_OPTION_SLUG_SECTION, 'section');		// URL слаг раздела
	add_option(SPC_OPTION_SLUG_STATUS, 'status');		// URL слаг раздела
}

// ------------------------- Изображения продукта -------------------------
//define('SPC_THUMBNAIL_55x55',		'spc_thumbnail_50x50');
define('SPC_THUMBNAIL_100x100' ,	'spc_thumbnail_100x100');
add_action( 'init', 'spcSetProductThumbnails', 0);
function spcSetProductThumbnails()
{
	//add_image_size(SPC_THUMBNAIL_55x55, 55, 55, true);
	add_image_size(SPC_THUMBNAIL_100x100, 100, 100, true);		
}


// Страница параметров плагина
add_action('admin_menu', 'spctCreateAdminMenu');
function spctCreateAdminMenu() 
{
	add_options_page(
		__('Catalog Options', 'spc'), 
		get_option(SPC_OPTION_PLUGIN_TITLE), 
		'manage_options', 'spc', 'spcOptions' );
}
function spcOptions() 
{
	if (!current_user_can( 'manage_options' ))
		wp_die( __( 'You do not have sufficient permissions to access this page.','spc') );
	
	include(plugin_dir_path(__FILE__).'options.php');
}



// ------------------------- Типы данных -------------------------
require (plugin_dir_path(__FILE__) . 'post-type.php');


// ------------------------- Общие функции -------------------------
// Возвращает значение произвольных полей
function spcGetMeta($postId, $customField) 
{
	$values = get_post_meta($postId, $customField);
	if (count($values) == 0) 
		return '';
	else
		return trim($values[0]);		
}
// Устанавливает значение произвольных полей
function spcSetMeta($postId, $customField, $value) 
{
	add_post_meta($postId, $customField, $value, true) 
		or update_post_meta($postId, $customField, $value);	
}


function spcGetImage($postId, $thumbnailType=SPC_THUMBNAIL_100x100)
{
	$post_thumbnail_id = get_post_thumbnail_id($postId);  
	if ($post_thumbnail_id) {  
		$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, $thumbnailType);  
		return $post_thumbnail_img[0];  
	}  		
}