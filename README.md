# WHM API PHP Client

## Sumário

- [Introdução](#introdução)
- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Uso](#uso)
- [Funções Disponíveis](#funções-disponíveis)
- [Tratamento de Erros](#tratamento-de-erros)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Introdução

`WhmApi` é uma classe PHP para interagir com a API do WHM/cPanel. A classe permite criar, suspender, reativar e terminar contas de hospedagem no WHM.

## Pré-requisitos

- PHP 7.4 ou superior
- Extensão cURL para PHP
- Acesso ao WHM com privilégios de root ou API
- Token de API do WHM

## Instalação

1. Clone ou faça download deste repositório.
2. Inclua a classe `WhmApi` no seu projeto PHP.

## Uso

1. Gere um token de API no WHM (WHM > Development > Manage API Tokens).
2. Configure a URL do WHM, o nome de usuário e o token no seu script PHP.

### Exemplo de Uso

```php
<?php

require __DIR__.'/vendor/autoload.php';

use MaRuoppolo/WhmApi;

// Configurações do WHM
$whmUrl = 'https://meu-whm-server.com:2087';
$username = 'root'; // Usuário do WHM
$token = 'seu-token-de-acesso'; // Token de API

// Cria uma instância da API
$whmApi = new WhmApi($whmUrl, $username, $token);

// Criar uma nova conta
$domain = 'exemplo.com';
$user = 'exemplo';
$password = 'senha-segura';
$plan = 'plano1';

$response = $whmApi->createAccount($domain, $user, $password, $plan);
print_r($response);

// Suspender uma conta
$response = $whmApi->suspendAccount($user, 'Pagamento atrasado');
print_r($response);

// Reativar uma conta
$response = $whmApi->unsuspendAccount($user);
print_r($response);

// Terminar uma conta
$response = $whmApi->terminateAccount($user);
print_r($response);
