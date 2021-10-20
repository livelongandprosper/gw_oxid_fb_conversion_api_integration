<?php

/**
 *
 * @package   tabslAbo
 * @version   1.3.1
 * @license   vetena.de
 * @link      https://oxid-module.eu
 * @author    Tobias Merkl <support@oxid-module.eu>
 * @copyright Tobias Merkl | 2020-10-01
 *
 * This Software is the property of Tobias Merkl
 * and is protected by copyright law, it is not freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be
 * prosecuted by civil and criminal law.
 *
 * 514b037abfd7daf6f97b32bc5632ec2c
 *
 **/

use OxidEsales\Eshop\Core\Registry;

$aLang = [
    'charset' => 'UTF-8',

    'SHOP_MODULE_GROUP_gw_oxid_fb_conversion_api_integration_settings'                  => 'Facebook Conversion API - Grundkonfiguration',
	'SHOP_MODULE_GROUP_gw_oxid_fb_conversion_api_integration_purchase_addinfo_settings' => 'Facebook Conversion API - Zu übermittelnde Benutzer-Zusatzfelder für Kauf-Event',
    'SHOP_MODULE_GROUP_gw_oxid_fb_conversion_api_integration_test_settings'             => 'Facebook Conversion API - Event-Test-Optionen',

    'SHOP_MODULE_gw_oxid_fb_conversion_api_integration_key'                         => 'Conversion API Key',
    'HELP_SHOP_MODULE_gw_oxid_fb_conversion_api_integration_key'                    => '',
    'SHOP_MODULE_gw_oxid_fb_conversion_api_integration_pixelid'                         => 'FB Pixel ID',
    'HELP_SHOP_MODULE_gw_oxid_fb_conversion_api_integration_pixelid'                    => '',
    'SHOP_MODULE_gw_oxid_fb_conversion_api_integration_apiversion'                         => 'FB Pixel ID',
    'HELP_SHOP_MODULE_gw_oxid_fb_conversion_api_integration_apiversion'                    => '',

	'SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_phone'                         => 'Telefonnummer',
	'HELP_SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_phone'                    => 'Wird gehasht (sha256) übergeben.',
	'SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_firstname'                         => 'Vorname (Rechnungsadresse)',
	'HELP_SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_firstname'                    => 'Wird gehasht (sha256) übergeben.',
	'SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_lastname'                         => 'Nachname (Rechnungsadresse)',
	'HELP_SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_lastname'                    => 'Wird gehasht (sha256) übergeben.',
	'SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_city'                         => 'Stadt (Rechnungsadresse)',
	'HELP_SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_city'                    => 'Wird gehasht (sha256) übergeben.',
	'SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_zip'                         => 'Postleitzahl (Rechnungsadresse)',
	'HELP_SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_zip'                    => 'Wird gehasht (sha256) übergeben.',
	'SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_country'                         => 'Land (Rechnungsadresse)',
	'HELP_SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_country'                    => 'Wird gehasht (sha256) übergeben.',
	'SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_ip'                         => 'IP-Adresse',
	'HELP_SHOP_MODULE_gw_oxid_fb_conversion_api_integration_purchase_addinfo_ip'                    => 'Wird <strong>nicht</strong> gehasht übergeben (ggf. aktuelle Datenschutz-Vorgaben beachten).',

	'SHOP_MODULE_gw_oxid_fb_conversion_api_integration_testcode'                         => 'Test-Code (Wert für test_event_code; z.B: {test_event_code: TEST9325})',
	'HELP_SHOP_MODULE_gw_oxid_fb_conversion_api_integration_testcode'                    => 'Bei jeder Event-Übermittlung an Facebook wird ein Fekd test_event_code mit dem hier angegebenen Wert übermittelt. So kann man die Einbindung unter "Events testen" überprüfen. Für dne Livebetrieb, muss dieses Feld wieder geleert werden.',

];
