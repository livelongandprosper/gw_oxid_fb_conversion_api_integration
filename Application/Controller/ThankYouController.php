<?php
namespace gw\gw_oxid_fb_conversion_api_integration\Application\Controller;

use OxidEsales\Eshop\Core\Registry;

/**
 * Extend ThankYouController to send FB purchase event.
 */
class ThankYouController extends ThankYouController_parent {

	/**
	 * https://graph.facebook.com/{API_VERSION}/{PIXEL_ID}/events?access_token={TOKEN}
	 *
	 *
	 *
	 *
	 */
	public function render() {

		$oConfig = $this->getConfig();
		$return_value = parent::render();

		$conversionApiVersion = $this->getFbConversionApiVersion();
		$conversionApiFbPixel = $this->getFbConversionApiFbPixelId();
		$conversionApiKey = $this->getFbConversionApiKey();

		if($conversionApiVersion && $conversionApiFbPixel && $conversionApiKey) {
			// generate and submit fb purchase event
			$oBasket = $this->getBasket();
			$oBasketPrice = $oBasket->getPrice();
			$fBasketPrice = $oBasketPrice->getPrice();
			$currency = $oBasket->getBasketCurrency();
			$oBasketUser = $oBasket->getBasketUser();
			$UrlString =
				'https://graph.facebook.com/'
				.urlencode($conversionApiVersion)
				.'/'
				.urlencode($conversionApiFbPixel)
				.'/events?access_token='
				.urlencode($conversionApiKey)
			;
			$purchaseData = array(
				"data" => array(
					array(
						"event_name" => "Purchase",
						"event_time" => time(),
						"action_source" => "website",
						"event_id" => "purchase.".md5($oBasket->getOrderId()),
						"event_source_url" => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
						"custom_data" => [
							"currency" => $currency->name,
							"value" => $fBasketPrice,
						],
						"user_data" => array_merge(
							$this->getAdditionalPurchaseUserData(),
							[
								"em" => array(hash("sha256", $oBasketUser->oxuser__oxusername->value))
							]
						),
					)
				)
			);
			$this->gwServerRequest($UrlString, array('Content-Type:application/json'), $purchaseData);
		} else {
			$oBasket = $this->getBasket();
			$logger = Registry::getLogger();
			$logger->error("gw_oxid_fb_conversion_api_integration: credentials are not completely set, event_id: ". "purchase.".md5($oBasket->getOrderId()) ."", []);
		}
		return $return_value;
	}

	/**
	 *
	 * @return string
	 */
	private function getFbConversionApiTestCode() {
		$oConfig = $this->getConfig();
		return $oConfig->getConfigParam('gw_oxid_fb_conversion_api_integration_testcode');
	}

	/**
	 *
	 * @return string
	 */
	private function getFbConversionApiVersion() {
		$oConfig = $this->getConfig();
		return $oConfig->getConfigParam('gw_oxid_fb_conversion_api_integration_apiversion');
	}

	/**
	 *
	 * @return string
	 */
	private function getFbConversionApiKey() {
		$oConfig = $this->getConfig();
		return $oConfig->getConfigParam('gw_oxid_fb_conversion_api_integration_key');
	}

	/**
	 *
	 * @return string
	 */
	private function getFbConversionApiFbPixelId() {
		$oConfig = $this->getConfig();
		return $oConfig->getConfigParam('gw_oxid_fb_conversion_api_integration_pixelid');
	}

	/**
	 * @param $UrlString
	 * @param array $httpHeader
	 * @param null $postFields
	 * @return array|mixed|object
	 */
	private function gwServerRequest($UrlString, array $httpHeader, $postFields = null) {
		$curl_connection = curl_init();
		curl_setopt(
			$curl_connection,
			CURLOPT_URL,
			$UrlString);

		// if there is post data, post data
		if($postFields) {
			if($this->getFbConversionApiTestCode()) {
				$postFields['test_event_code'] = $this->getFbConversionApiTestCode();
			}

			$postFieldsJson = json_encode($postFields);
			// print_r($postFieldsJson);

			curl_setopt($curl_connection, CURLOPT_POST, 1);
			curl_setopt(
				$curl_connection,
				CURLOPT_POSTFIELDS,
				$postFieldsJson)
			;
		}

		curl_setopt($curl_connection, CURLOPT_HTTPHEADER, $httpHeader);

		// receive server response ...
		curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);

		// set connection timeout
		curl_setopt($curl_connection,CURLOPT_CONNECTTIMEOUT, 10);

		// set curl timeout
		curl_setopt($curl_connection,CURLOPT_TIMEOUT, 10);

		$response = curl_exec ($curl_connection);

		// curl info
		$curl_info = curl_getinfo($curl_connection);

		if($curl_info['http_code'] != '200') {
			$logger = Registry::getLogger();
			$logger->error("gw_oxid_fb_conversion_api_integration: response " . $curl_info['http_code'] . ", event_id: ". $postFields['data']['event_id'] .", curl_info: ".print_r($curl_info, true), []);
		}

		/*
		print_r($UrlString);
		print_r($response);
		print_r($curl_info);
		*/

		// close connections to server
		curl_close ($curl_connection);

		return json_decode($response); // parse json string to object and return
	}

	/**
	 * @see https://developers.facebook.com/docs/marketing-api/conversions-api/parameters/customer-information-parameters#fn
	 * @return array
	 */
	private function getAdditionalPurchaseUserData() {
		$returnValue = [];
		$oBasket = $this->getBasket();
		$oBasketUser = $oBasket->getBasketUser();
		$oConfig = $this->getConfig();

		if($oConfig->getConfigParam('gw_oxid_fb_conversion_api_integration_purchase_addinfo_phone')) {
			if($oBasketUser->oxuser__oxfon->value) {
				$returnValue['ph'] = hash("sha256", $oBasketUser->oxuser__oxfon->value);
			}
		}
		if($oConfig->getConfigParam('gw_oxid_fb_conversion_api_integration_purchase_addinfo_firstname')) {
			if($oBasketUser->oxuser__oxfname->value) {
				$returnValue['fn'] = hash("sha256", $oBasketUser->oxuser__oxfname->value);
			}
		}
		if($oConfig->getConfigParam('gw_oxid_fb_conversion_api_integration_purchase_addinfo_lastname')) {
			if($oBasketUser->oxuser__oxlname->value) {
				$returnValue['ln'] = hash("sha256", strtolower($oBasketUser->oxuser__oxlname->value));
			}
		}
		if($oConfig->getConfigParam('gw_oxid_fb_conversion_api_integration_purchase_addinfo_city')) {
			if($oBasketUser->oxuser__oxcity->value) {
				$returnValue['ct'] = hash("sha256", strtolower($oBasketUser->oxuser__oxcity->value));
			}
		}
		if($oConfig->getConfigParam('gw_oxid_fb_conversion_api_integration_purchase_addinfo_zip')) {
			if($oBasketUser->oxuser__oxcity->value) {
				$returnValue['zp'] = hash("sha256", strtolower($oBasketUser->oxuser__oxcity->value));
			}
		}
		if($oConfig->getConfigParam('gw_oxid_fb_conversion_api_integration_purchase_addinfo_country')) {
			$oCountry = oxNew(\OxidEsales\Eshop\Application\Model\Country::class);
			$oCountry->load($oBasketUser->oxuser__oxcountryid->value);
			if($oCountry->oxcountry__oxisoalpha2->value) {
				$returnValue['country'] = hash("sha256", strtolower($oCountry->oxcountry__oxisoalpha2->value));
			}
		}
		if($oConfig->getConfigParam('gw_oxid_fb_conversion_api_integration_purchase_addinfo_ip')) {
			if($ipAddress = $_SERVER['REMOTE_ADDR']) {
				$returnValue['client_ip_address'] = $ipAddress;
			}
		}
		return $returnValue;
	}

}
?>
