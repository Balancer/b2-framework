<?php

class b2f_project extends b2_object
{
	function file($file_relative_name)
	{
		$full_file_name = $this->project_dir().'/'.$file_relative_name;
		if(!file_exists($full_file_name))
			return blib_array::factory();

		return blib_array::factory(explode("\n", file_get_contents($full_file_name)));
	}

	function _nav_name_def() { return config('project.nav_name'); }

	function project_dir()
	{
		return dirname(dirname(dirname($this->class_file())));
	}

	function router() { return $this->b2()->load('b2f_router'); }

	function _title_def() { return config('project.title'); }

	function url() { return '/'; }
}
