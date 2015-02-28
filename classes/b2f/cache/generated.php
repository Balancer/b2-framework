<?php

class b2f_cache_generated extends bors_object
{
	var $root_src_dir = '/var/www/www.balancer.ru/bors-site/webroot/_cg';
	var $root_cache_dir = '/var/www/www.balancer.ru/htdocs/cache-static/_cg';
	var $root_dir = '/var/www/www.balancer.ru/htdocs/_cg';
	var $root_url = 'http://www.balancer.ru/_cg';

	function pre_parse() { return false; }
	function pre_show() { return false; }
	function modify_time() { return time(); }
	function url() { return $this->root_url().'/'.$this->arg('year').'/'.$this->hash.'.'.$this->arg('ext'); }
	function url_ex($page) { return $this->url(); }
	function cache_static() { return false; }

	function _access_engine_def() { return NULL; }

	function access()
	{
		$access = $this->access_engine();
		if(!$access)
			$access = config('access_default');
//			bors_throw(ec('Не задан режим доступа к ').$this->object_titled_dp_link());

		return bors_load($access, $this);
	}

	function can_be_empty() { return false; }

	function data_load()
	{
		$file = $this->root_src_dir().'/'.$this->arg('year').'/'.$this->id().'.json';
		if(!file_exists($file))
			return $this->set_is_loaded(false);

		$this->data = json_decode(file_get_contents($file), true);

		$this->hash = md5($this->data['data']);

		if($this->hash != $this->id())
		{
			$target_file = $this->root_src_dir().'/'.$this->arg('year').'/'.$this->hash.'.json';
			mkpath(dirname($target_file));
			file_put_contents($target_file, file_get_contents($file));
		}

		$this->generator = bors_load($this->data['generator_class'], $this->data['data']);

		if(!$this->generator)
			return $this->set_is_loaded(false);

		return $this->set_is_loaded(true);
	}

	function content()
	{
		$cache_file = $this->root_cache_dir().'/'.$this->arg('year').'/'.$this->hash.'.'.$this->arg('ext');
		mkpath(dirname($cache_file));
		$this->generator->set_attr('save_to', $cache_file);
		@header('Content-type: ' . $this->generator->content_type());
		return $this->generator->content();
	}
}
