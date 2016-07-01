<?php

class Controller
{
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		global $currentModule;

		include 'modules/'.$currentModule.'/views/'.$viewName.'.php';
	}
}
