<?php

include __DIR__.'/../includes/includes.php';
/*$tlg = new Telegram ('1944732317:AAFsHCxY0-6ewG4pWfWjqC9F9BhzGRWWr8g');*/
$tlg = new Telegram ('1944732317:AAFsHCxY0-6ewG4pWfWjqC9F9BhzGRWWr8g');
print_r ($tlg->sendDocument ([
	'chat_id' => 824748678,
	'caption' => "Backup\n@MandrackBOT\n".date ('d/m/Y H:i:s'),
	'document' => curl_file_create (__DIR__.'/../recebersmsbot.db')
]));