<?php

use JuweelwinkelWristler\controllers\FeedController;
use JuweelwinkelWristler\controllers\WebhookController;
use JuweelwinkelWristler\controllers\WristlerController;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin Name: Juweelwinkel Wristler
 * Description: Wristler connection for Juweelwinkel
 * Version: 1.0.0
 * Author: Jeroen Venderbosch
 * License: GPL-2.0+
 * Text Domain: jw-wristler
 */


class Juweelwinkel_Wristler
{
	
	const TEXT_DOMAIN = 'jw-wristler';
	
	const CRYPT_CYPH = 'AES-128-CTR';
	const CRYPT_KEY = 'jw_wrist_port';
	const CRYPT_IV = '1234567891011121';
	
	
	public static string $plugin_root_path;
	public static string $plugin_asset_path;
	
	const TOKEN = '439cfd84-5b4e-4215-93e4-e8ee6d17a45b';
	
	const HEADER = 'X-Wristler-Token';
	
	const META_SELECTED_REFERENCE_UUID = 'selectedReferenceUuid';
	
	const API_BASE_ROUTE = 'jw_wrist/v1/api';
	
	public function __construct()
	{
		require __DIR__ . '/vendor/autoload.php';
		
		self::$plugin_root_path = plugin_dir_url(__FILE__);
		self::$plugin_asset_path = plugin_dir_url(__FILE__) . 'src/assets';
		
		add_action('rest_api_init', [$this, 'jw_wrist_register_feed_route']);
		add_action('rest_api_init', [$this, 'jw_wrist_register_webhook_route']);
		add_action('rest_api_init', [$this, 'jw_wrist_register_wristler_route']);
	}
	
	public function jw_wrist_register_feed_route()
	{
		register_rest_route(self::API_BASE_ROUTE, '/feed', [
			'methods' => 'GET',
			'callback' => [new FeedController(), 'index'],
		]);
	}
	
	public function jw_wrist_register_webhook_route()
	{
		register_rest_route(self::API_BASE_ROUTE, '/webhook', [
			'methods' => 'GET',
			'callback' => [WebhookController::class, 'index'],
		]);
	}
	
	public function jw_wrist_register_wristler_route()
	{
		register_rest_route(self::API_BASE_ROUTE, '/wristler', [
			'methods' => 'GET',
			'callback' => [WristlerController::class, 'index'],
		]);
	}
	
	public static function cm_encrypt($value){
		return openssl_encrypt(
			$value,
			self::CRYPT_CYPH,
			self::CRYPT_KEY,
			0,
			self::CRYPT_IV
		);
	}
	
	public static function cm_decrypt($value)
	{
		return openssl_decrypt(
			$value,
			self::CRYPT_CYPH,
			self::CRYPT_KEY,
			0,
			self::CRYPT_IV
		);
	}
}

$juweelwinkel_wristler = new Juweelwinkel_Wristler();

//register_activation_hook(__FILE__, array('Juweelwinkel_Wristler', 'plugin_activated'));
