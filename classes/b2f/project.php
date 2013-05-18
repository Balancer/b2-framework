<?php

class b2f_project extends b2_object
{
	function router() { return $this->b2()->load('b2f_router'); }

	function project_dir()
	{
		return dirname(dirname(__DIR__));
	}

	function file($file_relative_name)
	{
		$full_file_name = $this->project_dir().'/'.$file_relative_name;
		if(!file_exists($full_file_name))
			return blib_array::factory();

		return blib_array::factory(explode("\n", file_get_contents($full_file_name)));
	}
}
