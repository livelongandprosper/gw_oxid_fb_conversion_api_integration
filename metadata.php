<?php
/**
 * @abstract
 * @author 	Gregor Wendland <oxid@gregor-wendland.com>
 * @copyright Copyright (c) 2021, Gregor Wendland
 * @package gw
 * @version 2021-10-18
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2'; // see https://docs.oxid-esales.com/developer/en/6.0/modules/skeleton/metadataphp/version20.html

/**
 * Module information
 */
$aModule = array(
    'id'           => 'gw_oxid_fb_conversion_api_integration',
    'title'        => 'Facebook Conversion API Integration',
//     'thumbnail'    => 'out/admin/img/logo.jpg',
    'version'      => '1.1',
    'author'       => 'Gregor Wendland',
    'email'		   => 'oxid@gregor-wendland.de',
    'url'		   => 'https://www.gregor-wendland.com',
    'description'  => array(
    	'de'		=> 'Integriert folgende Conversion API Events
							<ul>
								<li>Purchase (Kauf)</li>
							</ul>
						',
    ),
    'extend'       => array(
		OxidEsales\Eshop\Application\Controller\ThankYouController::class => gw\gw_oxid_fb_conversion_api_integration\Application\Controller\ThankYouController::class,
    ),
    'settings' => array(
		// General Settings
		['group' => 'gw_oxid_fb_conversion_api_integration_settings', 'name' => 'gw_oxid_fb_conversion_api_integration_key', 'type' => 'str', 'value' => ''],
		['group' => 'gw_oxid_fb_conversion_api_integration_settings', 'name' => 'gw_oxid_fb_conversion_api_integration_pixelid', 'type' => 'str', 'value' => ''],
		['group' => 'gw_oxid_fb_conversion_api_integration_settings', 'name' => 'gw_oxid_fb_conversion_api_integration_apiversion', 'type' => 'str', 'value' => 'v12.0'],

		// Additional Info Settings
		['group' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_settings', 'name' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_phone', 'type' => 'bool', 'value' => false],
		['group' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_settings', 'name' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_firstname', 'type' => 'bool', 'value' => false],
		['group' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_settings', 'name' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_lastname', 'type' => 'bool', 'value' => false],
		['group' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_settings', 'name' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_city', 'type' => 'bool', 'value' => false],
		['group' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_settings', 'name' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_zip', 'type' => 'bool', 'value' => false],
		['group' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_settings', 'name' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_country', 'type' => 'bool', 'value' => false],
		['group' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_settings', 'name' => 'gw_oxid_fb_conversion_api_integration_purchase_addinfo_ip', 'type' => 'bool', 'value' => false],

		// Test Settings
		['group' => 'gw_oxid_fb_conversion_api_integration_test_settings', 'name' => 'gw_oxid_fb_conversion_api_integration_testcode', 'type' => 'str', 'value' => ''],
	),
	'files'			=> array(
    ),
	'blocks' => array(
		// frontend

		// backend
/*		array(
			'template' => 'voucherserie_main.tpl',
			'block' => 'admin_voucherserie_main_form',
			'file' => 'Application/views/blocks/admin/admin_voucherserie_main_form.tpl'
		),
*/
	),
	'events'       => array(
		'onActivate'   => '\gw\gw_oxid_fb_conversion_api_integration\Core\Events::onActivate',
		'onDeactivate' => '\gw\gw_oxid_fb_conversion_api_integration\Core\Events::onDeactivate'
	),
	'controllers'  => [
	],
	'templates' => [
	]
);
?>
