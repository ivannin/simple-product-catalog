<?php
/**
 * Параметры плагина
 */
define('SPC_OPTION_PARAM_PLUGIN_TITLE',		'plugin_title');
define('SPC_OPTION_PARAM_CAPTION_PRODUCT',	'caption_product');
define('SPC_OPTION_PARAM_CAPTION_PRODUCTS',	'caption_products');

define('SPC_OPTION_PARAM_USE_QUANTITY',		'use_quo');
define('SPC_OPTION_PARAM_USE_IMAGE',		'use_image');
define('SPC_OPTION_PARAM_CURRENCY_SYMBOL',	'currency_symbol');
define('SPC_OPTION_PARAM_SLUG_PRODUCT',		'slug_product');
define('SPC_OPTION_PARAM_SLUG_SECTION',		'slug_section');
define('SPC_OPTION_PARAM_SLUG_STATUS',		'slug_status');

// Принимаем данные
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (isset($_POST[SPC_OPTION_PARAM_PLUGIN_TITLE]))
		update_option(SPC_OPTION_PLUGIN_TITLE, $_POST[SPC_OPTION_PARAM_PLUGIN_TITLE]);

	if (isset($_POST[SPC_OPTION_PARAM_CAPTION_PRODUCT]))
		update_option(SPC_OPTION_CAPTION_PRODUCT, $_POST[SPC_OPTION_PARAM_CAPTION_PRODUCT]);

	if (isset($_POST[SPC_OPTION_PARAM_CAPTION_PRODUCTS]))
		update_option(SPC_OPTION_CAPTION_PRODUCTS, $_POST[SPC_OPTION_PARAM_CAPTION_PRODUCTS]);


	if (isset($_POST[SPC_OPTION_PARAM_USE_QUANTITY]))
		update_option(SPC_OPTION_USE_QUANTITY, TRUE);
	else
		update_option(SPC_OPTION_USE_QUANTITY, FALSE);


	if (isset($_POST[SPC_OPTION_PARAM_USE_IMAGE]))
		update_option(SPC_OPTION_USE_IMAGE, TRUE);
	else
		update_option(SPC_OPTION_USE_IMAGE, FALSE);

	if (isset($_POST[SPC_OPTION_PARAM_CURRENCY_SYMBOL]))
		update_option(SPC_OPTION_CURRENCY_SYMBOL, $_POST[SPC_OPTION_PARAM_CURRENCY_SYMBOL]);

	if (isset($_POST[SPC_OPTION_PARAM_SLUG_PRODUCT]))
		update_option(SPC_OPTION_SLUG_PRODUCT, $_POST[SPC_OPTION_PARAM_SLUG_PRODUCT]);

	if (isset($_POST[SPC_OPTION_PARAM_SLUG_SECTION]))
		update_option(SPC_OPTION_SLUG_SECTION, $_POST[SPC_OPTION_PARAM_SLUG_SECTION]);

	if (isset($_POST[SPC_OPTION_PARAM_SLUG_STATUS]))
		update_option(SPC_OPTION_SLUG_STATUS, $_POST[SPC_OPTION_PARAM_SLUG_STATUS]);



	// Сброс правил перезациси URL
	flush_rewrite_rules();

}
?>
<style type="text/css">
#spc fieldset {
	border:  1px solid gray;
	border-radius: 4px;
	padding:  10px;
	margin-right:  10px;
	margin-bottom:  10px;	
}
#spc legend {
	font-size: 14pt;
	padding: 5px;
}	
#spc fieldset div {
	margin-bottom:  10px;
	clear:  both;
}
#spc fieldset div:not(:last-child) {
	border-bottom: 1px dotted gray;
}
#spc fieldset div p, #spc fieldset div li {
	margin-left:  160px;
}	
#spc label {
	display:  block;
	float:  left;
	width:  150px;
	margin-right: 10px;
	padding-top: 4px;
	text-align: right;
	font-weight: bold;
}
#spc input {
	width:  50%;			
}
#spc input[type="checkbox"] {
	width:  20px;			
}	
</style>
<div id="spc">
	<h2><?php 
		echo '<img src="' . plugins_url( 'img/product-icon-32x32.png' , __FILE__ ) . '" > ';
		echo get_option(SPC_OPTION_PLUGIN_TITLE);
	?></h2>
	<form method="post" action="#">
		<fieldset>
			<legend><?php _e('Item Captions', 'spc')?></legend>
			<div>
				<label for="pluginTitle"><?php _e('Menu Caption', 'spc')?></label>
				<input id="pluginTitle" type="text" 
					name="<?php echo SPC_OPTION_PARAM_PLUGIN_TITLE ?>" 
					value="<?php echo get_option(SPC_OPTION_PLUGIN_TITLE) ?>" />
				<p><?php _e('This parameter set the title of your catalog at admin menu', 'spc')?></p>
			</div>
			<div>
				<label for="product"><?php _e('Item Singular Name', 'spc')?></label>
				<input id="product" type="text" 
					name="<?php echo SPC_OPTION_PARAM_CAPTION_PRODUCT ?>" 
					value="<?php echo (get_option(SPC_OPTION_CAPTION_PRODUCT)) ?>" />
				<p><?php _e('This parameter set the singular name of catalog items', 'spc')?></p>
			</div>
			<div>
				<label for="products"><?php _e('Item Multimple Name', 'spc')?></label>
				<input id="products" type="text" 
					name="<?php echo SPC_OPTION_PARAM_CAPTION_PRODUCTS ?>" 
					value="<?php echo (get_option(SPC_OPTION_CAPTION_PRODUCTS)) ?>" />
				<p><?php _e('This parameter set the multiple name of catalog items', 'spc')?></p>
			</div>
		</fieldset>

		<fieldset>
			<legend><?php _e('Catalog Options', 'spc')?></legend>
			<div>
				<label for="useQuo"><?php _e('Use Qauntity', 'spc')?></label>
				<input id="useQuo" type="checkbox" 
					name="<?php echo SPC_OPTION_PARAM_USE_QUANTITY ?>" 
					value="1" <?php if (get_option(SPC_OPTION_USE_QUANTITY)) echo 'checked="checked"' ?> />
				<p><?php _e('This parameter set to use product quantity field in your catalog', 'spc')?></p>
			</div>

			<div>
				<label for="useImage"><?php _e('Use Image', 'spc')?></label>
				<input id="useImage" type="checkbox" 
					name="<?php echo SPC_OPTION_PARAM_USE_IMAGE ?>" 
					value="1" <?php if (get_option(SPC_OPTION_USE_IMAGE)) echo 'checked="checked"' ?> />
				<p><?php _e('This parameter set to use product thumbnail column in your catalog', 'spc')?></p>
			</div>

			<div>
				<label for="currencySymbol"><?php _e('Currency Symbol', 'spc')?></label>
				<input id="currencySymbol" type="text" 
					name="<?php echo SPC_OPTION_PARAM_CURRENCY_SYMBOL ?>" 
					value="<?php echo (get_option(SPC_OPTION_CURRENCY_SYMBOL)) ?>" />
				<p><?php _e('This parameter set the currency symbol in your catalog', 'spc')?></p>
			</div>
		</fieldset>	
		
		<fieldset>
			<legend><?php _e('URL Slugs', 'spc')?></legend>
			<p><?php _e('Please change the settings with caution. It is better to go to a technical expert.', 'spc')?></p>
			<div>
				<label for="slugProduct"><?php _e('Product', 'spc')?></label>
				<input id="currencySymbol" type="text" 
					name="<?php echo SPC_OPTION_PARAM_SLUG_PRODUCT ?>" 
					value="<?php echo (get_option(SPC_OPTION_SLUG_PRODUCT)) ?>" />
				<p><?php _e('This parameter set the product slug', 'spc')?></p>
			</div>		
			<div>
				<label for="slugProduct"><?php _e('Section', 'spc')?></label>
				<input id="currencySymbol" type="text" 
					name="<?php echo SPC_OPTION_PARAM_SLUG_SECTION ?>" 
					value="<?php echo (get_option(SPC_OPTION_SLUG_SECTION)) ?>" />
				<p><?php _e('This parameter set the section slug', 'spc')?></p>
			</div>				
			<div>
				<label for="slugProduct"><?php _e('Status', 'spc')?></label>
				<input id="currencySymbol" type="text" 
					name="<?php echo SPC_OPTION_PARAM_SLUG_STATUS ?>" 
					value="<?php echo (get_option(SPC_OPTION_SLUG_STATUS)) ?>" />
				<p><?php _e('This parameter set the status slug', 'spc')?></p>
			</div>				
		</fieldset>			
		
		<div>
			<button type="submit" class="button button-primary"><?php _e('Update settings', 'spc')?></button>
		</div>		
			
	</form>

</div>