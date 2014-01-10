<?php

if(!defined('COMPOSER_ROOT'))
	define('COMPOSER_ROOT', __DIR__);

if(empty($GLOBALS['bors.composer.class_loader']))
	$GLOBALS['bors.composer.class_loader'] = require_once COMPOSER_ROOT.'/vendor/autoload.php';

if(!defined('BORS_SITE'))
	define('BORS_SITE', __DIR__);

require_once COMPOSER_ROOT.'/vendor/balancer/bors-core/init.php';
