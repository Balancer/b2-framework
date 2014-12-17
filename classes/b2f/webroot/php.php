<?php

class b2f_webroot_php extends bors_page
{
	static $params = array();

	static function run($params = array())
	{
		$page_file = $_SERVER["SCRIPT_FILENAME"];

		if(empty(self::$params[$page_file]))
			$params[$page_file] = $params;

		static $runned = false;

		if($runned)
			return;

		$runned = true;

		$page = new self($page_file);
		$page->attr = $params;

		$page->_configure();
		$page->data_load();

		echo $page->content();

		bors_exit();
	}

	function can_be_empty() { return false; }
	function is_loaded() { return (bool) $this->body(); }

	function body()
	{
		return $this->attr('body');
	}

	function data_load()
	{
		ob_start();
		require($this->id());
		$body = ob_get_contents();
		ob_end_clean();

		$this->set_attr('body', $body);
		$this->set_is_loaded(true);
		return true;
	}

	static function load($id)
	{
		return bors_load(get_called_class(), $id);
	}
}
