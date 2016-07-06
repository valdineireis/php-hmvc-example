<?php

class Core
{
	private $currentController;
	private $currentAction;
	private $params;

	public function __construct() {
		$this->currentController = 'HomeController';
		$this->currentAction = 'index';
		$this->params = array();
	}

	public function run() {
		$this->extractUrl();

		require_once 'core/Controller.php';

		$this->verifyController();
		$this->verifyMethod();

		$c = new $this->currentController();
		call_user_func_array(array($c, $this->currentAction), $this->params);
	}

	private function extractUrl() {
		$url = explode('index.php', $_SERVER['PHP_SELF']);
		$url = end($url);

		if (!empty($url)) {
			$url = explode('/', $url);
			array_shift($url);

			$this->setCurrentModule($url[0]);

			if (isset($url[1]) && strlen($url[1]) > 1) {
				$this->currentController = ucfirst($url[1]).'Controller';
			} else {
				$this->currentController = 'HomeController';
			}

			if (isset($url[2]) && !empty($url[2])) {
				$this->currentAction = $url[2];
			} else {
				$this->currentAction = 'index';
			}

			if (count($url) > 3) {
				$this->params = $url;
				array_splice($this->params, 0, 3);
			}
		} else {
			$this->setCurrentModule('site');
		}
	}

	private function verifyController() {
		if (!class_exists($this->currentController)) {
			$this->currentController = 'ErroController';
			require_once 'core/ErroController.php';
			$this->setCurrentModule('_erros');
		}
	}

	private function verifyMethod() {
		if (!method_exists($this->currentController, $this->currentAction)) {
			if ($this->getCurrentModule() == '_erros') {
				header("Location: /");
			} else {
				$controle = str_replace("Controller", "", $this->currentController);
				header("Location: /".$this->getCurrentModule()."/".lcfirst($controle));
			}
			exit;
		}
	}

	private function getCurrentModule() {
		global $currentModule;
		return $currentModule;
	}

	private function setCurrentModule($module = '') {
		global $currentModule;
		$currentModule = $module;
	}
}
