<?php

$request_file = $_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['REQUEST_URI'];
if(file_exists($request_file) && !is_dir($request_file))
	return false;

$GLOBALS['b2.stat']['start_microtime'] = microtime(true);

// Инициализация фреймворка
require_once(__DIR__.'/init.php');

// http://phpdebugbar.com/docs/rendering.html
// https://github.com/maximebf/php-debugbar
$GLOBALS['debugbar'] = new DebugBar\StandardDebugBar();
$GLOBALS['debugbar_renderer'] = $GLOBALS['debugbar']->getJavascriptRenderer();
bors_page::add_template_data_array('head_append', $GLOBALS['debugbar_renderer']->renderHead());

//require('/home/balancer/bors/xxx/b2-loader/vendor/autoload.php');
use Tracy\Debugger;
Debugger::enable(Debugger::DEVELOPMENT);
//Debugger::dump(time());
//Debugger::log('log:'.time());

//b2d::d(time());

$uri = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$b2 = new b2;
$b2->init();
$result = NULL;


	if($b2->conf('debug.execute_trace'))
		debug_execute_trace("\$b2->load_uri('$uri');");

	if($object = $b2->load_uri($uri))
	{
		// Если это редирект
		if(!is_object($object))
			return $b2->go($object);

		$processed = $object->pre_show();
		if($processed === true)
		{
			if(config('debug_header_trace'))
				@header('X-Bors-show-pre-show: Yes');

			return true;
		}

		$result = $object->direct_content();
	}

// Если объект всё, что нужно нарисовал сам, то больше нам делать нечего. Выход.
if($result === true)
	return;

// Если объект вернул строку, то рисуем её и выходим.
if($result)
{
	echo $result;
	return true;
}

@header("HTTP/1.0 404 Not Found");
echo "Not found: <b>$uri</b>";
return true;
