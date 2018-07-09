<?php

defined("ABSPATH") or die;

/*
Plugin Name: Mortgage Calculator
Description: The Best Mortgage Calculator Plugin for WordPress
Version: 1.0.0
Author: WPManageNinja
Author URI: https://wpmanageninja.com
Plugin URI: https://wpmanageninja.com/products/ninja-mortgage-calculator-plugin
License: GPLv2 or later
Text Domain: ninja_mortgage
Domain Path: /languages
*/

include "load.php";
define("NINJA_MORTGAGE_PLUGIN_DIR_URL", plugin_dir_url(__FILE__));
define("NINJA_MORTGAGE_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
define("NINJA_MORTGAGE_PLUGIN_DIR_VERSION", plugin_dir_path(__FILE__));


class  NINJAMortgageCalculator
{
	public function boot()
	{
		$this->commonHooks();
		$this->adminHooks();
		$this->publicHooks();
		$this->loadTextDomain();
	}



	public function commonHooks()
	{
	
		add_action('init', array('NinjaMortgage\Classes\CPT', 'register'));
		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts') );
	}


	public function adminHooks()
	{
		
		add_action('admin_menu', array('NinjaMortgage\Classes\Menu', 'addAdminMenuPages') );

	}


	public function publicHooks()
	{
		
	}

	public function enqueueScripts()
	{
		
	}


	public function loadTextDomain()
	{
		
	}

	
}


add_action('plugins_loaded', function(){
	$ninjaMortgageCalculator = new NINJAMortgageCalculator();
	$ninjaMortgageCalculator->boot(); 
});

	