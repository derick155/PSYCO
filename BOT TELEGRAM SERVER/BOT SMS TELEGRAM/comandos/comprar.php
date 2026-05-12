<?php

$tlg->answerCallbackQuery([
    'callback_query_id' => $tlg->Callback_ID(),
    'text'              => 'Gerando PIX...'
]);

$valor          = number_format((float) $complemento, 2, '.', '');
$transaction_id = $tlg->UserID() . mt_rand(111111, 999999);
$nome           = $tlg->FirstName() ?? 'Cliente';

$mp        = new MisticPay(CLIENT_ID_MISTICPAY, CLIENT_SECRET_MISTICPAY);
$pagamento = $mp->criarCobranca($valor, $nome, '00000000000', $transaction_id, 'Recarga de saldo bot SMS');

$dados      = $pagamento['data'] ?? $pagamento ?? [];
$copia_cola = $dados['pixCopiaECola'] ?? $dados['qrCode'] ?? '';
$qr_img     = $dados['qrCodeImage']   ?? '';

if (empty($copia_cola)) {

    $tlg->editMessageText([
        'chat_id'      => $tlg->ChatID(),
        'text'         => "<em>⚠️ Erro ao gerar o PIX, tente novamente!</em>",
        'parse_mode'   => 'html',
        'message_id'   => $tlg->MessageID(),
        'reply_markup' => $tlg->buildInlineKeyboard([[
            $tlg->buildInlineKeyBoardButton("Tentar Novamente", null, "/comprar {$valor}")
        ]])
    ]);

} else {

    $tlg->editMessageText([
        'chat_id'    => $tlg->ChatID(),
        'text'       => "✅ <b>PIX gerado com sucesso!</b>\n\n"
                      . "💰 <b>Valor:</b> R$ {$valor}\n"
                      . "🔑 <b>ID:</b> <code>{$transaction_id}</code>\n\n"
                      . "📋 <b>Pix Copia e Cola:</b>\n<code>{$copia_cola}</code>\n\n"
                      . "<u>Após o pagamento o saldo será adicionado automaticamente.</u>\n"
                      . "⏳ Expira em <b>30 minutos</b>.",
        'parse_mode' => 'html',
        'message_id' => $tlg->MessageID()
    ]);

    if (!empty($qr_img)) {
        $tlg->sendPhoto([
            'chat_id' => $tlg->ChatID(),
            'photo'   => $qr_img,
            'caption' => "📷 QR Code — R$ {$valor}"
        ]);
    }

}
