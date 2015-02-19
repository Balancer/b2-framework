<?php

class b2f_view extends b2_object
{
	function pre_parse() { return false; }
	function pre_show() { return false; }
	function modify_time() { return false; }

	function _access_engine_def() { return NULL; }

	function access()
	{
		$access = $this->access_engine();
		if(!$access)
			$access = config('access_default');
//			bors_throw(ec('Не задан режим доступа к ').$this->object_titled_dp_link());

		return bors_load($access, $this);
	}
}
