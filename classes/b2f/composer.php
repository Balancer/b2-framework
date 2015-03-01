<?php

class b2f_composer
{
	static function update() { echo "b2f_composer::Update!\n"; }
	static function install() { echo "b2f_composer::Install!\n"; }

	public static function postAutoloadDump(Event $event)
	{
        $composer = $event->getComposer();
        $io = $event->getIO();
        $io->write('<info>post, post, post</info>');
	}
}
