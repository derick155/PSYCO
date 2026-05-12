<?php

include __DIR__.'/../includes/includes.php';

$tlg = new Telegram (TOKEN_BOT);
$bd_tlg = new bdTelegram (__DIR__.'/../recebersmsbot.db');

foreach ($bd_tlg->todosUsuarios () as $usuario){

	$msg = @$tlg->sendMessage ([
		'chat_id' => $usuario ['id_telegram'],
		'from_chat_id' => CHAT_ID_NOTIFICACAO,
		'text' => "<b>🤓 RECEBA SMS COM NÚMEROS NOVOS PARA CRIAR CONTAS</b>

- Telegram
- Whatsapp
- 99app
- Banqi
- Uber
- TIKTOK
- KWAI
- IFOOD 
- E muitos outros...

💬 Receba os códigos no nosso bot
@smsgobrasil_bot

📍 Nosso grupo
@smsgobr

*Preço e serviço incomparável com os existentes.
*Mais de 4 mil números disponíveis",
'parse_mode' => 'html'
	]);


	if ($msg ['ok']){

		$nome = $msg ['result']['chat']['first_name'] ?? $usuario ['id'];
		echo "{$nome} enviada\n";

	}

}
