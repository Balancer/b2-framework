<?php

use Kunststube\Router\Router,
    Kunststube\Router\Route;

class b2f_router extends b2_object
{
	function load_uri($uri)
	{
//		$slim = new \Slim\Slim();
		$router = new Router;
		foreach($this->b2()->projects() as $project)
		{
			foreach($project->file('data/route.dat') as $route_rule)
			{
				echo "$route_rule<br/>\n";

				if(preg_match('/^(GET|POST)\s+(\S+)\s+(\S+)$/', $route_rule, $m))
					$router->add($m[2], ['class' => $m[3], 'action' => 'show'] /*,
						function($router)
						{
//							echo "Found 
							var_dump($router);
						} */
					);

				$path = parse_url($uri, PHP_URL_PATH);
				$router->route($path);
			}
		}
	}
}
