<?php

use Kunststube\Router\Router,
    Kunststube\Router\Route;

class b2f_router extends b2_object
{
	private $router = NULL;

	function load_uri($uri)
	{
//		$slim = new \Slim\Slim();
		if(!$this->router)
		{
			$this->router = new Router;
			foreach($this->b2()->projects() as $project)
			{
				foreach($project->file('data/route.dat') as $route_rule)
				{
//					echo "$route_rule<br/>\n";

					if(preg_match('/^(GET|POST)\s+(\S+)\s+(\S+)$/', $route_rule, $m))
					{
//						var_dump($m);
						$this->router->add($m[2], array('class_name' => $m[3]));
					}
				}
			}

			$this->router->defaultCallback(function (Route $route) {
				$disp = $route->dispatchValues();
//				var_dump($route, $disp);
				$x = $this->b2()->load($disp['class_name'], NULL);
				return $x;
			});
		}

		$path = parse_url($uri, PHP_URL_PATH);
		try {
			$object = $this->router->route($path);
		} catch(Exception $e)
		{
			$object = NULL;
		}

		return $object;
	}
}
