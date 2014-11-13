<?php

class b2f_haction_dispatcher extends b2_object
{
	function access() { return $this; }
	function can_read() { return true; }

	function pre_show()
	{
		$hash = $this->id();
		$x = b2f_haction::find(array('hash' => $hash))->first();

		var_dump($hash, $x);

//		if(!$x || $x->expire_time() < time())
//			return bors_message(ec('Устаревшая или некорректная ссылка'));

		var_dump($x);
//		echo $x->data();

		return true;
	}
}
