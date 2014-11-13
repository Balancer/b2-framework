<?php

/*
	Класс-обёртка для базовых функций работы с моделями
*/

class b2m
{
	static function create($class_name, $data = array())
	{
		// Пока просто обёртка старого метода
		return bors_new($class_name, $data);
	}
}
