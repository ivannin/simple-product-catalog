<?php
/**
 * Таксономия и тип записей
 */
define('SPC_TYPE_PRODUCT', 'spc_product');
define('SPC_TAXONOMY_SECTION', 'spc_section');
define('SPC_TAXONOMY_STATUS', 'spc_status');

// ------------------------- Тип продуктов -------------------------
add_action( 'init', 'spcProductTypeInit', 0 );
function spcProductTypeInit() 
{

	$urlSlug = get_option(SPC_OPTION_SLUG_PRODUCT);
	if (empty($urlSlug)) $urlSlug = 'product';
		
	$product = get_option(SPC_OPTION_CAPTION_PRODUCT);
	$products = get_option(SPC_OPTION_CAPTION_PRODUCTS);

	$labels = array(
		'name'                => $products,
		'singular_name'       => $product,
		'menu_name'           => get_option(SPC_OPTION_PLUGIN_TITLE),
		'parent_item_colon'   => __( 'Parent', 'spc' ) . ' ' . $product . ':',
		'all_items'           => __( 'All', 'spc' ) . ' ' . $products,
		'view_item'           => __( 'View Product', 'spc' ),
		'add_new_item'        => __( 'Add New', 'spc' ) . ' ' . $product,
		'add_new'             => __( 'New', 'spc' ) . ' ' . $product,
		'edit_item'           => __( 'Edit', 'spc' ) . ' ' . $product,
		'update_item'         => __( 'Update', 'spc' ) . ' ' . $product,
		'search_items'        => __( 'Search', 'spc' ),
		'not_found'           => __( 'No products found', 'spc' ),
		'not_found_in_trash'  => __( 'No products found in Trash', 'spc' ),
	);
	$rewrite = array(
		'slug'                => $urlSlug,
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => SPC_TYPE_PRODUCT,
		'description'         => $product . ' ' . __( 'information pages', 'spc' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'post-thumbnails', 'comments', 'revisions', 'custom-fields', 'page-attributes'),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => plugins_url('/img/product-icon-16x16-bw.png', __FILE__ ),
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type(SPC_TYPE_PRODUCT, $args );
}


// ------------------------- Разделы каталога -------------------------
add_action( 'init', 'spcSectionTaxonomyInit', 0 );
function spcSectionTaxonomyInit()  
{
	$urlSlug = get_option(SPC_OPTION_SLUG_SECTION);
	if (empty($urlSlug)) $urlSlug = 'section';


	$labels = array(
		'name'                       => __( 'Sections', 'spc' ),
		'singular_name'              => __( 'Section', 'spc' ),
		'menu_name'                  => __( 'Section', 'spc' ),
		'all_items'                  => __( 'All Sections', 'spc' ),
		'parent_item'                => __( 'Parent Section', 'spc' ),
		'parent_item_colon'          => __( 'Parent Section:', 'spc' ),
		'new_item_name'              => __( 'New Section Name', 'spc' ),
		'add_new_item'               => __( 'Add New Section', 'spc' ),
		'edit_item'                  => __( 'Edit Section', 'spc' ),
		'update_item'                => __( 'Update Section', 'spc' ),
		'separate_items_with_commas' => __( 'Separate sections with commas', 'spc' ),
		'search_items'               => __( 'Search sections', 'spc' ),
		'add_or_remove_items'        => __( 'Add or remove sections', 'spc' ),
		'choose_from_most_used'      => __( 'Choose from the most used sections', 'spc' ),
	);
	$rewrite = array(
		'slug'                       => $urlSlug,
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy(SPC_TAXONOMY_SECTION, SPC_TYPE_PRODUCT, $args );
}


// ------------------------- Статусы каталога -------------------------
add_action( 'init', 'spcStatusTaxonomyInit', 0 );
function spcStatusTaxonomyInit()  
{

	$urlSlug = get_option(SPC_OPTION_SLUG_STATUS);
	if (empty($urlSlug)) $urlSlug = 'status';

	$labels = array(
		'name'                       => __( 'Statuses', 'spc' ),
		'singular_name'              => __( 'Status', 'spc' ),
		'menu_name'                  => __( 'Status', 'spc' ),
		'all_items'                  => __( 'All Statuses', 'spc' ),
		'parent_item'                => __( 'Parent Status', 'spc' ),
		'parent_item_colon'          => __( 'Parent Status:', 'spc' ),
		'new_item_name'              => __( 'New Status Name', 'spc' ),
		'add_new_item'               => __( 'Add New Status', 'spc' ),
		'edit_item'                  => __( 'Edit Status', 'spc' ),
		'update_item'                => __( 'Status Section', 'spc' ),
		'separate_items_with_commas' => __( 'Separate statuses with commas', 'spc' ),
		'search_items'               => __( 'Search statuses', 'spc' ),
		'add_or_remove_items'        => __( 'Add or remove statuses', 'spc' ),
		'choose_from_most_used'      => __( 'Choose from the most used statuses', 'spc' ),
	);
	$rewrite = array(
		'slug'                       => $urlSlug,
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy(SPC_TAXONOMY_STATUS, SPC_TYPE_PRODUCT, $args );
}


// ------------------------- Колонки в таблице -------------------------
// Дополнительные колонки в таблице каталога
define('STC_COLUMN_SKU',	'colSKU');			// Артикул
define('STC_COLUMN_PRICE',	'colPrice');		// Цена
define('STC_COLUMN_QUO',	'colQUO');			// Количество на складе
define('STC_COLUMN_IMAGE',	'colImage');		// Изображение


add_filter('manage_' . SPC_TYPE_PRODUCT . '_posts_columns', 'spcSetColumnsHead');  
add_action('manage_' . SPC_TYPE_PRODUCT . '_posts_custom_column', 'spcShowColumnsContent', 10, 2); 

// Названия колонок в таблице каталога  
function spcSetColumnsHead($defaults) 
{

	// Изменяем существующие колонки
	$defaults['title'] = __('Title', 'spc');
	unset($defaults['author']);
	unset($defaults['comments']);
	unset($defaults['date']);

	// Добавляем новые колонки в нужном порядке
	$result = array();

	$count = 0;
	foreach ($defaults as $key => $value)
	{
		$count++;
		switch ($count)
		{
			case 2:
				// Картинка
				if (get_option(SPC_OPTION_USE_IMAGE))
					$result[STC_COLUMN_IMAGE]	= __('Image', 'spc');
				break;

			case 3:
				// Артикул
				$result[STC_COLUMN_SKU]		= __('SKU', 'spc');	
				// Цена
				$result[STC_COLUMN_PRICE] = __('Price', 'spc');	
				// Количество
				if (get_option(SPC_OPTION_USE_QUANTITY))
					$result[STC_COLUMN_QUO]	= __('Quantity', 'spc');	
				break;
		}
		$result[$key] = $value;
	}


    return $result;  
}  
  
// Вывод данных в таблице каталога  
function spcShowColumnsContent($column_name, $postId) 
{  
    switch ($column_name)
	{
		// Артикул
		case STC_COLUMN_SKU:
			echo spcGetMeta($postId, __('SKU', 'spc'));
			break;

		// Цена
		case STC_COLUMN_PRICE:
			$price = spcGetMeta($postId, __('Price', 'spc'));
			if (!empty($price))
				echo $price, ' ', get_option(SPC_OPTION_CURRENCY_SYMBOL);
			break;

		// Количество
		case STC_COLUMN_QUO:
			echo spcGetMeta($postId, __('Quantity', 'spc'));
			break;

		// Картинка
		case STC_COLUMN_IMAGE:
			$image = spcGetImage($postId, SPC_THUMBNAIL_100x100);  
			if ($image)
				echo '<img src="' . $image . '" alt="" />'; 
	}
}

/*
 * ADMIN COLUMN - SORTING - MAKE HEADERS SORTABLE
 * https://gist.github.com/906872
 */
add_filter('manage_edit-' . SPC_TYPE_PRODUCT . '_sortable_columns', 'spcSortColumns');
function spcSortColumns($columns) 
{
	$custom = array(
		STC_COLUMN_SKU 		=> STC_COLUMN_SKU,
		STC_COLUMN_PRICE 	=> STC_COLUMN_PRICE,
		STC_COLUMN_QUO		=> STC_COLUMN_QUO,
	);
	return wp_parse_args($custom, $columns);
	/* or this way
		$columns['concertdate'] = 'concertdate';
		$columns['city'] = 'city';
		return $columns;
	*/
}

/*
 * ADMIN COLUMN - SORTING - ORDERBY
 * http://scribu.net/wordpress/custom-sortable-columns.html#comment-4732
 */
add_filter('request', 'spcColumnsOrderby');
function spcColumnsOrderby( $vars ) 
{
	if ( isset( $vars['orderby'] ) && $vars['orderby'] == STC_COLUMN_SKU) 
	{
		$vars = array_merge( $vars, array(
			'meta_key' => __('SKU', 'spc'),
			//'orderby' => 'meta_value_num', // does not work
			'orderby' => 'meta_value'
			//'order' => 'asc' // don't use this; blocks toggle UI
		));
	}
	if ( isset( $vars['orderby'] ) && $vars['orderby'] == STC_COLUMN_PRICE) 
	{
		$vars = array_merge( $vars, array(
			'meta_key' => __('Price', 'spc'),
			//'orderby' => 'meta_value_num', // does not work
			'orderby' => 'meta_value'
			//'order' => 'asc' // don't use this; blocks toggle UI
		));
	}
	if ( isset( $vars['orderby'] ) && $vars['orderby'] == STC_COLUMN_QUO) 
	{
		$vars = array_merge( $vars, array(
			'meta_key' => __('Quantity', 'spc'),
			//'orderby' => 'meta_value_num', // does not work
			'orderby' => 'meta_value'
			//'order' => 'asc' // don't use this; blocks toggle UI
		));
	}
	return $vars;
}

// Установка полей каталога при ручном добавлении
add_action('wp_insert_post', 'spcSetProductDefaults');
function spcSetProductDefaults($postId)
{
    if ($_GET['post_type'] == SPC_TYPE_PRODUCT) 
	{
		spcSetMeta($postId, __('SKU', 'spc'), '');
		spcSetMeta($postId, __('Price', 'spc'), '');
		if (get_option(SPC_OPTION_USE_QUANTITY))
			spcSetMeta($postId, __('Quantity', 'spc'), 0);
	}
    return true;
}


// ------------------------- Иконка на странице аминистрирования -------------------------
add_action('admin_head', 'spcAdminIconCSS');
function spcAdminIconCSS() 
{ ?>
<style type="text/css">
	.icon32-posts-spc_product {
		background: url('/wp-content/plugins/simple-product-catalog/img/product-icon-32x32.png') no-repeat !important;
	}
</style>
<?php
	

}