<?php

if(empty($GLOBALS['stat']['start_microtime']))
	$GLOBALS['stat']['start_microtime'] = microtime(true);

class b2f
{
	static function init_framework()
	{
		require_once(dirname(__DIR__).'/init.php');
	}

	static function instance()
	{
		static $instance = NULL;
		if(!$instance)
			 $instance = new b2f;

		return $instance;
	}

	var $projects = array();

	function register_project($project_class, $host = '*', $path = '')
	{
		$key = "$project_class-$host-$path";
		if(empty($this->projects[$key]))
		{
			$this->projects[$key] = array(
				'host' => $host,
				'path' => $path,
				'project' => b2::instance()->load($project_class, NULL),
			);
		}

		return $this;
	}

	function run()
	{
		global $bors_map;
//		var_dump($_SERVER);
//		$url = http_build_url(array(
//			'scheme' => 'http', //FIXME!
//			'host' => $_SERVER['HTTP_HOST'],
//			'path' => $_SERVER['REQUEST_URI'],
//			'query' => ...
//		));

		$url = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

		echo "$url<br/>";

		foreach($this->projects as $project_data)
		{
			extract($project_data);
			$class_file = $project->class_file();
			if(preg_match('!^(.+)/classes/'.str_replace('_', '/', $project->class_name()).'.php$!', $class_file, $m))
			{
				$bors_site = $m[1];
				if(file_exists($f = $bors_site.'/url_map.php'))
				{
					$bors_map = array();
					$map = array();

					require_once($f);

					foreach(array_unique(array_merge($map, $bors_map)) as $r)
					{
						echo "$r<br/>";
					}
				}
			}
			echo "<li>{$project}, {}</li>";
//			$object = $project->find_by_url($url);
		}

		echo 'ok '.bors_time::now();
	}
}
