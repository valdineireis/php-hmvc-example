<?php

class Core
{
	public function run() {
		global $currentModule;

		$url = explode('index.php', $_SERVER['PHP_SELF']);
		$url = end($url);
		$params = array();

		if (!empty($url)) {
			
			$url = explode('/', $url);
			array_shift($url);

			$currentModule = $url[0];

			if (isset($url[1]) && strlen($url[1]) > 1) {
				$currentController = ucfirst($url[1]).'Controller';
			} else {
				$currentController = 'HomeController';
			}

			if (isset($url[2]) && !empty($url[2])) {
				$currentAction = $url[2];
			} else {
				$currentAction = 'index';
			}

			if (count($url) > 3) {
				$params = $url;
				array_splice($params, 0, 3);
			}

		} else {
			$currentModule = 'site';
			$currentController = 'HomeController';
			$currentAction = 'index';
		}

		require_once 'core/Controller.php';

		$c = new $currentController();
		call_user_func_array(array($c, $currentAction), $params);
	}
}
