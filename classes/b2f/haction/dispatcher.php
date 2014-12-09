<?php

class b2f_haction_dispatcher extends bors_object
{
	function access() { return $this; }
	function can_read() { return true; }

	function pre_show()
	{
		$hash = $this->id();
		$x = b2f_haction::find(array('hash' => $hash))->first();

		if(!$x || $x->expire_time() < time())
			return bors_message(ec('Устаревшая или некорректная ссылка'));

		if(!$x->actor() || $x->actor()->is_null())
			return bors_message(ec('Ошибочная ссылка'));

		return $x->actor()->on_action($x->actor_data());
	}
}
