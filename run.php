#!/usr/bin/env php
<?php

// Ищем composer, он либо у нас в подкаталоге, если это новый стиль ...
if(file_exists($d=__DIR__.'/vendor/autoload.php'))
	require_once($d);
// ... либо уровнем выше, если старый bors-core
elseif(file_exists($d=dirname(__DIR__).'/composer/vendor/autoload.php'))
	require_once($d);

if(!defined('BORS_CORE'))
{
	if(file_exists($d=dirname(__DIR__).'/bors-core'))
	{
		// Если у нас в родительском каталоге есть bors-core, то используем
		// классическую инициализаци.
		define('BORS_CORE', $d);
		require_once(BORS_CORE.'/init.php');
	}
	else
	{
		// В противном случае работаем по-новому, через composer.
		define('BORS_SITE', __DIR__);
		bors::init();
	}
}

$host = config('webserver.host', 'localhost');
$port = config('webserver.port', '8000');

echo "Run php-webserver at http://$host:$port/", PHP_EOL;
chdir('htdocs/');

// hhvm --mode server -vServer.Type=fastcgi -vServer.Port=9000
// hhvm --mode daemon -vServer.Type=fastcgi -vServer.Port=9000
// http://www.hhvm.com/blog/1817/fastercgi-with-hhvm

system("php -S $host:$port ".__DIR__."/main.php");
