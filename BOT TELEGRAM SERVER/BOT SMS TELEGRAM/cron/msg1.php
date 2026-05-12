<?php

include __DIR__.'/../includes/includes.php';

$tlg = new Telegram (TOKEN_BOT);
$bd_tlg = new bdTelegram (__DIR__.'/../recebersmsbot.db');

foreach ($bd_tlg->todosUsuarios () as $usuario){


	$msg = $tlg->sendMessage ([
	 	'chat_id' => $usuario ['id_telegram'],
	 	'from_chat_id' => CHAT_ID_NOTIFICACAO,
	 	'text' => "🚀 <b>EAI RAPAA QUER NUMEROS NOVOS PRA USAR NOS ESQUEMA>>>>>>PROMOÇAO</b>🚀🚀🚀",
		'parse_mode' => 'html'
	 ]); 



	if ($msg ['ok']){

		$nome = $msg ['result']['chat']['first_name'] ?? $usuario ['id'];
		echo "{$nome} enviada\n";

	}

}
