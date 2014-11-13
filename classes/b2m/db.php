<?php

class b2m_db extends bors_object_db
{
	// Пока заглушки. Уходим от глобального контекста, так что
	// в будущем нужно реализовать корректную загрузку локальных
	// проектных данных.
	function project() { return bors()->main_object()->project(); }
//	function create($data) { return bors_new($data); }
}
