#!/usr/bin/env php
<?php

require_once(__DIR__.'/vendor/autoload.php');

if(!defined('BORS_CORE'))
{
	define('BORS_SITE', __DIR__);
	bors::init();
}

$host = config('webserver.host', 'localhost');
$port = config('webserver.port', '8000');

echo "Run php-webserver at http://$host:$port/", PHP_EOL;
chdir('htdocs/');
// hhvm --mode server -vServer.Type=fastcgi -vServer.Port=9000
// hhvm --mode daemon -vServer.Type=fastcgi -vServer.Port=9000
// http://www.hhvm.com/blog/1817/fastercgi-with-hhvm
system("php -S $host:$port ".__DIR__."/main.php");
