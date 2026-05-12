<?php

include __DIR__.'/../includes/dados_bot.php';
include __DIR__.'/../includes/rDis.php';
include __DIR__.'/../includes/ApiSMS.php';
include __DIR__.'/../includes/SMSActivate.php';
include __DIR__.'/../includes/MisticPay.php';
include __DIR__.'/../includes/Telegram.php';
include __DIR__.'/../includes/TelegramTools.php';
include __DIR__.'/../includes/bdTelegram.php';
include __DIR__.'/../includes/funcoes.php';
include __DIR__.'/../includes/ControleProcessos.php';

$mp     = new MisticPay(CLIENT_ID_MISTICPAY, CLIENT_SECRET_MISTICPAY);
$tlg    = new TelegramTools(TOKEN_BOT);
$bd_tlg = new bdTelegram();
$redis  = rDis::con();

// Busca últimos pagamentos aprovados na MisticPay
$ultimos_pagamentos = $mp->buscaPagamentos(20);

$lista = $ultimos_pagamentos['data'] ?? $ultimos_pagamentos['results'] ?? [];

if (empty($lista)) exit;

foreach ($lista as $pagamento) {

    $status = $pagamento['status'] ?? '';
    if (strtoupper($status) !== 'APPROVED') continue;

    // O transactionId foi gerado como: UserID + rand(111111,999999)
    $transaction_id = $pagamento['transactionId'] ?? $pagamento['external_reference'] ?? '';
    $id_telegram    = substr($transaction_id, 0, -6);

    if (empty($transaction_id) || empty($id_telegram)) continue;

    // Evita processar o mesmo pagamento duas vezes
    if (!empty($bd_tlg->getResgate($transaction_id))) continue;

    $usuarioTlg = $tlg->getUsuarioTlg($id_telegram);
    $usuarioBd  = $bd_tlg->getUsuario($id_telegram);

    if (empty($usuarioBd) || empty($usuarioTlg)) continue;

    $valor_pagamento = $pagamento['amount'] ?? $pagamento['transaction_amount'] ?? 0;
    $valor           = incrementoPorcento($valor_pagamento, BONUS);

    ### SISTEMA AFILIADO ###
    if (STATUS_AFILIADO && $bd_tlg->checkPrimeiroResgate($id_telegram) && $bd_tlg->checkReferencia($id_telegram)) {

        $afiliado = $bd_tlg->getReferenciaIndicado($id_telegram);

        if (isset($afiliado)) {

            $saldo_afiliado     = $bd_tlg->getSaldo($afiliado['id_telegram']);
            $novo_saldo_afiliado = getPorcento($valor_pagamento, BONUS_AFILIADO);
            $bd_tlg->setSaldo($afiliado['id_telegram'], $novo_saldo_afiliado + $saldo_afiliado);

            $tlg->sendMessage([
                'chat_id'    => $afiliado['id_telegram'],
                'text'       => "👏 Parabéns, um dos seus indicados acaba de fazer uma recarga.\n<b>Por indicação você ganhou R$" . number_format($novo_saldo_afiliado, 2) . " (" . BONUS_AFILIADO . "%) da recarga dele, use /saldo</b>",
                'parse_mode' => 'html'
            ]);

        }

    }

    if ($bd_tlg->addResgate($id_telegram, $transaction_id, $valor)) {

        echo "Pagamento: {$usuarioTlg['first_name']} ({$id_telegram}) - Valor: {$valor}\n";

        $tlg->sendMessage([
            'chat_id'    => $id_telegram,
            'text'       => "<b>✅ Pronto, saldo de R${$valor} adicionado na sua conta!</b>",
            'parse_mode' => 'html'
        ]);

        $tlg->sendMessage([
            'chat_id'    => CHAT_ID_NOTIFICACAO,
            'text'       => "<b>💰 Saldo Resgatado por {$usuarioTlg['first_name']}!</b>\nID: {$id_telegram}\nValor: R${$valor}",
            'parse_mode' => 'html'
        ]);

        $bd_tlg->setSaldo($id_telegram, $valor + $usuarioBd['saldo']);

    }

}
