<?php

global $currentModule;

spl_autoload_register(function ($class) {
	global $currentModule;
	if (strpos($class, 'Controller') > -1) {
		if (file_exists('modules/'.$currentModule.'/controllers/'.$class.'.php')) {
			require_once('modules/'.$currentModule.'/controllers/'.$class.'.php');
		}
	} else if (file_exists('modules/'.$currentModule.'/models/'.$class.'.php')) {
		require_once('modules/'.$currentModule.'/models/'.$class.'.php');
	} else {
		require_once('core/'.$class.'.php');
	}
});

$core = new Core();
$core->run();
