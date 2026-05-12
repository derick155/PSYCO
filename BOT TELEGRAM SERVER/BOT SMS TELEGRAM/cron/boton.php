<?php include __DIR__.'/../includes/includes.php'; $tlg = new Telegram 
(TOKEN_BOT); $bd_tlg = new bdTelegram (__DIR__.'/../recebersmsbot.db'); 
foreach ($bd_tlg->todosUsuarios () as $usuario){
	$msg = $tlg->sendMessage ([
	 	'chat_id' => $usuario ['id_telegram'],
	 	'from_chat_id' => CHAT_ID_NOTIFICACAO,
	 	'text' => "PROMOCAO CONTINUA... BOT ON ✅
PROMOCAO MALUCA CHEGA DE ANDAR A PÉ FAZENDO UMA OU MAIS RECARGA DE R$:20.00 OU MAIS  NO BOT VC GANHA ESQUEMA + MATRIZ 99POP FASA SUA RECARGA PELO BOT E ME CHAMA NO PV @xKalElx PRA PEGA SEU ESQUEMA. PROMOCAO POR TEMPO LIMITADO...",
		'parse_mode' => 'html'
	 ]);
	if ($msg ['ok']){
		$nome = $msg ['result']['chat']['first_name'] ?? 
$usuario ['id'];
		echo "{$nome} enviada\n";
	}
}
