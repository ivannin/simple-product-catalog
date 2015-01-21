<?php
/**
 * Шорткоды плагина SPC
 *
 * 
 */
 

 
/**
 * spc-price - Вывод цены товара 
 * [spc-price id="" sku="" symbol="" currency=""]
 *		id 			- Идентификатор записи
 *		sku 		- артикул товара
 *		symbol		- символ валюты, по умолчанию берется из настроек плагина
 *		currency 	- вывод валюты, по умолчанию 'right'. Возможные значения:
 *						left	- вывод перед ценой без проблела, если нужен пробел, ставится в символе
 *						right	- вывод после цены без пробела, если нужен пробел, ставится в символе
 *						none	- символ не выводится
 *		decimals	- число знаков после запятой
 */
add_shortcode('spc-price', 'spcShortCodePrice');
function spcShortCodePrice($atts) 
{
    $param = shortcode_atts(array(
        'id' => '',
        'sku' => '',
        'symbol' => '',
        'currency' => 'right',
        'decimals' => 0,
    ), $atts);

	// Если не указаны параметры id или sku - возвращаем пустую строку
	if (empty($param['id']) &&  empty($param['sku'])) return '';
	
	// Если указан SKU и не указан ID, находим ID
	if (empty($param['id']) &&  !empty($param['sku']))
		$param['id'] = spcGetPostIdBySKU($param['sku']);
	
	// Получаем стоимость
	$price = spcGetMeta($param['id'], __('Price', 'spc'));
	// Если она не указана, ничего не делаем
	if (empty($price)) return '';
	
	// Если не указан символ, берем из настроек
	if (empty($param['symbol']))
		$param['symbol'] = get_option(SPC_OPTION_CURRENCY_SYMBOL);	

	// Форматируем цену
	$price = number_format($price, $param['decimals'], ',', ' ') . ' ';
	$price = str_replace(' ', '&nbsp;', $price);
	
	// Добавляем символ
	switch ($param['currency'])
	{
		case 'left':
			$price = $param['symbol'] . $price;
			break;
			
		case 'right':
			$price = $price . $param['symbol'];
			break;		
	}
	return $price;	
}


// Функция возвращает значение postId по значению артикула
function spcGetPostIdBySKU($sku)
{
	// Получаем массив ID по артикулам из кэша
	$ids = wp_cache_get(SPC_CACHE_POSTIDS, SPC_CACHE_GROUP);
	if (! $ids)
	{
		// Формируем массив
		$ids = array();
		$args = array(
			'post_type'			=> SPC_TYPE_PRODUCT,
			'post_status'  		=> 'publish',
			'posts_per_page'	=> -1,
			'caller_get_posts'	=> 1
		);
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) 
			while ($my_query->have_posts())
			{
				$my_query->the_post();
				$id = get_the_ID();
				$sku = spcGetMeta($id, __('SKU', 'spc'));
				if ($sku) $ids[$sku] = $id;
			}	
		wp_reset_query(); 
		
		// Кэшируем массив
		wp_cache_set(SPC_CACHE_POSTIDS, $ids, SPC_CACHE_GROUP, SPC_CACHE_TIMEOUT);
	}
	// Если id присуствует, возвращаем его
	if (isset($ids[$sku]))
		return $ids[$sku];
	else
		return false;
}



