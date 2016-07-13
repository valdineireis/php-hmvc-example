<?php
session_start();

require 'config.php';

spl_autoload_register(function ($class) 
{
	global $currentModule;

	if (strpos($class, 'Controller') > -1) {
		if (file_exists('modules/'.$currentModule.'/controllers/'.$class.'.php')) {
			require_once 'modules/'.$currentModule.'/controllers/'.$class.'.php';
		}
	} else if (file_exists('infra/models/'.$class.'.php')) {
		require_once 'infra/models/'.$class.'.php';
	} else if (file_exists('infra/repositories/'.$class.'.php')) {
		require_once 'infra/repositories/'.$class.'.php';
	} else if (file_exists('core/'.$class.'.php')) {
		require_once 'core/'.$class.'.php';
	}
});

$core = new Core();
$core->run();
