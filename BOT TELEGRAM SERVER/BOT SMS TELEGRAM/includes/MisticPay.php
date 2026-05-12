<?php

/*
 * MisticPay.php
 * Substitui o MercadoPago.php
 * API: https://api.misticpay.com
 */

class MisticPay {

    private $client_id;
    private $client_secret;
    private $base_url = 'https://api.misticpay.com';

    public function __construct($client_id, $client_secret) {
        $this->client_id     = $client_id;
        $this->client_secret = $client_secret;
    }

    // Cria cobrança PIX
    public function criarCobranca($valor, $nome, $cpf, $transaction_id, $descricao = 'Recarga de saldo') {
        return $this->request('POST', '/api/transactions/create', [
            'amount'        => (float) $valor,
            'payerName'     => $nome,
            'payerDocument' => $cpf,
            'transactionId' => (string) $transaction_id,
            'description'   => $descricao
        ]);
    }

    // Busca pagamentos aprovados recentes
    public function buscaPagamentos($limit = 20) {
        return $this->request('GET', '/api/transactions?status=APPROVED&limit=' . $limit, []);
    }

    // Consulta transação pelo ID
    public function consultarTransacao($transaction_id) {
        return $this->request('GET', '/api/transactions/' . $transaction_id, []);
    }

    private function request($method, $endpoint, $dados) {
        $ch = curl_init($this->base_url . $endpoint);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTPHEADER     => [
                'ci: ' . $this->client_id,
                'cs: ' . $this->client_secret,
                'Content-Type: application/json'
            ]
        ]);
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
        }
        $res = curl_exec($ch);
        curl_close($ch);
        return json_decode($res, true);
    }

}
