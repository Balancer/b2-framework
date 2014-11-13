<?php

class b2f_haction extends b2m_db
{
	function db_name() { return 'PTC'; }
	function table_name() { return 'hactions'; }

	function table_fields()
	{
		return array(
			'id',
			'hash',
			'expire_time' => array('name' => 'UNIX_TIMESTAMP(`expire_ts`)'),
			'actor_class_name',
			'actor_id',
			'actor_data' => array('type' => 'json'),
			'create_time' => array('name' => 'UNIX_TIMESTAMP(`create_ts`)'),
			'modify_time' => array('name' => 'UNIX_TIMESTAMP(`modify_ts`)'),
			'owner_id',
			'last_editor_id',
			'last_editor_ip',
			'last_editor_ua',
		);
	}

	function actor_data()
	{
		return json_decode($this->data['actor_data'], true);
	}

	static function add($actor_class_name, $actor_id = NULL, $actor_data = array(), $ttl = 86400)
	{
		return b2m::create(get_called_class(), array(
			'hash' => md5(rand()),
			'expire_time' => time() + $ttl,
			'actor_class_name' => $actor_class_name,
			'actor_id' => $actor_id,
			'actor_data' => json_encode($actor_data),
		));
	}

	function action_url()
	{
		return $this->project()->url().'_b2f/hactions/'.$this->hash();
	}
}
