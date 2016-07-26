<?php

abstract class Controller
{
	protected $template;

	public function __construct($nomeTemplate = 'default')
	{
		$this->template = $nomeTemplate;
	}

	public function loadView($viewName, $viewData = array()) 
	{
		global $currentModule;
		extract($viewData);
		include 'modules/'.$currentModule.'/views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) 
	{
		include 'templates/'.$this->template.'/index.php';
	}

	public function loadViewInTemplate($viewName, $viewData) 
	{
		global $currentModule;
		extract($viewData);
		include 'modules/'.$currentModule.'/views/'.$viewName.'.php';
	}
}
