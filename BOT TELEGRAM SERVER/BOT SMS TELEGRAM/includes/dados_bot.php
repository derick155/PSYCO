<?php

define ('MODO_DESENVOLVEDOR', false);

// =============================
// TOKEN DO BOT TELEGRAM
// =============================
define ('TOKEN_BOT', '8710789963:AAETWn-VeY2xSBIpT1fCEhwrleTATw1ZiIw'); // Pegue no @BotFather

// =============================
// API SMS ACTIVATE
// =============================
define ('KEY_SMS', 'SUA_CHAVE_SMS_ACTIVATE'); // https://sms-activate.ru/en/api2

// =============================
// MISTICPAY (substitui MercadoPago)
// =============================
define ('CLIENT_ID_MISTICPAY',     'ci_70oqnu0fuvw4t76');      // Painel MisticPay → Credenciais
define ('CLIENT_SECRET_MISTICPAY', 'cs_ms6u5ma78lcty5tllkxtoarbm');  // Painel MisticPay → Credenciais

// =============================
// CONFIGURAÇÕES GERAIS
// =============================
define ('PORCENTAGEM_LUCRO', 120); // % de lucro sobre o custo do SMS
define ('ADMS', [8710789963]); // Seu ID do Telegram (use @userinfobot para descobrir)

define ('CHAT_ID_NOTIFICACAO', '-1003647141213'); // ID do grupo de notificações
define ('GRUPO_ID',            '--1003647141213'); // ID do grupo do bot

// =============================
// SISTEMA DE BÔNUS
// =============================
define ('BONUS', 0);
define ('AFILIADOS', true);
define ('STATUS_BONUS_ADICAO', true);
define ('BONUS_ADICAO', 0.50);
define ('MINIMO_ADICAO', 50);

// =============================
// SISTEMA AFILIADOS
// =============================
define ('STATUS_AFILIADO', true);
define ('BONUS_AFILIADO', 15); // 15% do valor de recarga do indicado

// =============================
// ANTI CANCELAMENTO
// =============================
define ('ANTI_CANCELAMENTO', true);
define ('TEMPO_BLOCK', 1800);
define ('CANCELAMENTO_MINIMO', 3);
define ('VALOR_DESCONTO_BLOCK', 1);

// =============================
// PAÍSES DISPONÍVEIS
// =============================
define ('PAISES', [
	'73'  => '🇧🇷 Brasil',
	'187' => '🇺🇸 EUA',
	'0'   => '🇷🇺 Rússia',
	'117' => '🇵🇹 Portugal',
	'86'  => '🇮🇹 Itália',
	'87'  => '🇵🇾 Paraguai',
	'1'   => '🇺🇦 Ucrânia',
	'2'   => '🇰🇿 Cazaquistão',
	'3'   => '🇨🇳 China',
	'4'   => '🇵🇭 Filipinas',
	'6'   => '🇮🇩 Indonésia',
	'7'   => '🇲🇾 Malásia',
	'10'  => '🇻🇳 Vietnã',
	'14'  => '🇭🇰 Hong Kong',
	'15'  => '🇵🇱 Polônia',
	'16'  => '🇬🇧 Reino Unido',
	'19'  => '🇳🇬 Nigéria',
	'21'  => '🇪🇬 Egito',
	'22'  => '🇮🇳 Índia',
	'36'  => '🇨🇦 Canadá',
	'39'  => '🇦🇷 Argentina',
	'43'  => '🇩🇪 Alemanha',
	'46'  => '🇸🇪 Suécia',
	'50'  => '🇦🇺 Austrália',
	'52'  => '🇹🇭 Tailândia',
	'54'  => '🇲🇽 México',
	'56'  => '🇪🇸 Espanha',
]);
