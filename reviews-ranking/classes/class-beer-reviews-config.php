<?php

class Beer_Review_Config
{
	const beer_id = 77777777;
	const client_id = 'xxxxxxxxxxxxxxx';
	const client_secret = 'xxxxxxxxxxxx';
	const Beer_Feed = 'https://xxxxxxxx';

	private function __construct()
	{
		spl_autoload_register(array($this, 'autoload'));
	}

	public static function factory()
	{
		static $instance = false;

		if (!$instance) {
			$instance = new self();
		}

		return $instance;
	}

	private function autoload($class)
	{
		$file = plugin_dir_path(dirname(__FILE__)) . 'classes/class-' . str_replace('_', '-', strtolower($class)) . '.php';

		if (!file_exists($file)) {
			return false;
		}

		include_once $file;
		return true;
	}

}

Beer_Review_Config::factory();
