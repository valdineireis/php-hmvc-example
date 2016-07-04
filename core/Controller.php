<?php

class Controller
{
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		global $currentModule;

		include 'modules/'.$currentModule.'/views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		extract($viewData);
		include 'templates/default/index.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		global $currentModule;
		extract($viewData);
		include 'modules/'.$currentModule.'/views/'.$viewName.'.php';
	}
}
