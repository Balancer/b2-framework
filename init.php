<?php

if(!defined('COMPOSER_ROOT'))
{
	// Ищем composer, он либо у нас в подкаталоге, если это новый стиль ...
	if(file_exists(__DIR__.'/vendor/autoload.php'))
		define('COMPOSER_ROOT', __DIR__);
	// ... либо уровнем выше, если старый bors-core
	elseif(file_exists(dirname(__DIR__).'/composer/vendor/autoload.php'))
		define('COMPOSER_ROOT', dirname(__DIR__).'/composer');
	elseif(file_exists(($composer = dirname(dirname(dirname(__DIR__)))).'/vendor/autoload.php'))
		define('COMPOSER_ROOT', $composer);
}

if(empty($GLOBALS['bors.composer.class_loader']))
	$GLOBALS['bors.composer.class_loader'] = require COMPOSER_ROOT.'/vendor/autoload.php';

if(!defined('BORS_SITE'))
	define('BORS_SITE', __DIR__);

if(file_exists($f = COMPOSER_ROOT.'/vendor/balancer/bors-core/init.php'))
	require_once $f;
elseif(file_exists($f=dirname(__DIR__).'/bors-core/init.php'))
	require_once $f;

