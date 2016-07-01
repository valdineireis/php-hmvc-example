<?php

class Core
{
	public function run() {
		global $currentModule;

		$url = substr($_SERVER['PHP_SELF'], 10);

		if (!empty($url) && $url != 'index.php') {
			
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

		} else {
			$currentModule = 'site';
			$currentController = 'HomeController';
			$currentAction = 'index';
		}

		require_once 'core/Controller.php';

		$c = new $currentController();
		$c->$currentAction();
	}
}
