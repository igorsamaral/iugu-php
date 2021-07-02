# Introdução

Essa Lib foi construída com o intuito de torná-la flexível, de forma que todos possam utilizar todas as features, de todas as versões de API.

Você pode acessar a documentação oficial da Iugu acessando esse [link](https://dev.iugu.com/).

## Índice

- [Instalação](#instalação)
- [Configuração](#configuração)
- [Clientes](#clientes)
  - [Criando um cliente](#criando-um-cliente)
  - [Retornando clientes](#retornando-clientes)
  - [Retornando um cliente](#retornando-um-cliente)
- [Tokens e cobrança direta](#tokens-e-cobraça-direta)
  - [Criando Token](#criando-um-token)
  - [Cobrança direta](#cobrança-direta)
- [Faturas](#faturas)
  - [Criando uma fatura](#criando-uma-fatura)
  - [Retornando faturas](#retornando-faturas)
  - [Retornando uma fatura](#retornando-uma-fatura)

## Instalação

Instale a biblioteca utilizando o comando

`composer require igorsamaral/iugu-php`

## Configuração

Para incluir a biblioteca em seu projeto, basta fazer o seguinte:

```php
<?php

require __DIR__ . "/vendor/autoload.php"

$iugu = new Iugu\Client("SUA_CHAVE_DE_API");
```

### Definindo headers customizados

1. Se necessário for é possível definir headers http customizados para os requests. Para isso basta informá-los durante a instanciação do objeto `Client`:

```php
<?php

require __DIR__ . "/vendor/autoload.php"

$iugu = new iugu\Client(
    "SUA_CHAVE_DE_API",
    ["headers" => ["MEU_HEADER_CUSTOMIZADO" => "VALOR HEADER CUSTOMIZADO"]]
); 
```

E então, você pode poderá utilizar o cliente para fazer requisições ao Iugu.com.br, como nos exemplos abaixo.
## Clientes

Clientes representam os usuários de sua loja, ou negócio. Este objeto contém informações sobre eles, como nome, e-mail e telefone, além de outros campos.

### Criando um cliente

```php
<?php

$customer = $iugu->customers()->create([
    "email" => "joao.neves@email.com",
    "name" => "João das Neves",
    "notes" => "lorem...",
    "phone" => "999999999",
    "phone_prefix" => "11",
    "cpf_cnpj" => "11743685009",
    "zip_code" => "76814112",
    "number" => "100",
    "street" => "Rua Cabedelo",
    "city" => "Porto Velho",
    "state" => "RO",
    "district" => "Marcos Freire",
    "complement" => "complemento...",
    "custom_variables" => [
        "key" => "value"
    ]
]);
```
### Retornando clientes

```php
<?php

$customers = $iugu->customers()->getList();
```

### Retornando um cliente

```php
<?php

$customer = $iugu->customers()->get([
    "id" => "ID_DO_CLIENTE"
]);
```

## Tokens e cobraça direta

O Token é uma representação do meio de pagamento do cliente (por ex: seu cartão de crédito), sendo totalmente seguro, de forma que não é possível que alguém consiga as informações do cartão de crédito do cliente utilizando esse token. O token é gerado para uma transação específica, tornando-o ainda mais seguro.

### Criando um token

```php
<?php

$token = $iugu->paymentToken()->create([
    "account_id" => "ID_DA_SUA_CONTA_IUGU",
    "customer_id" => "ID_DO_CUSTOMER",
    "method" => "credit_card",
    "data" => [
        "number" => "4242424242424242",
        "verification_value" => "648",
        "first_name" => "João",
        "last_name" => "das Neves",
        "month" => "01",
        "year" => "2023"
    ],
    "test" => true,
]);
```
### Cobrança direta
Cobrança simples via boleto ou cartão de crédito.

```php
<?php

$charge = $iugu->charges()->create([
    "token" => "ID_DO_TOKEN_DE_PAGAMENTO_CRIADO",
    "customer_id" => "ID_DO_CUSTOMER",
    "total" => 10000,
        "payer" => [
            "cpf_cnpj" => "84752882000",
            "name" => "João das Neves",
            "address" => [
                "zip_code" => "72917210",
                "number" => "100"
            ]
        ],
    "items": [
        [
            "description" => "Descrição do item 1",
            "quantity" => 1,
            "price_cents" => 10000
        ]
    ]
]);
```

## Faturas

Cria uma fatura para um cliente.

### Criando uma fatura

```php
<?php

$invoice = $iugu->invoices()->create([
    "email" => "joao@email.com.br",
    "due_date" => "2021-07-21",
    "items" => [
        [
            "description" => "Descrição do item 1",
            "quantity" => 1,
            "price_cents" => 10000
        ]
    ],
    "total" => 10000,
    "payer" => [
        "cpf_cnpj" => "84752882000",
        "name" => "João das Neves",
        "address" => [
            "zip_code" => "72917210",
            "number" => "100"
        ]
    ]
]);
```

### Retornando faturas

```php
<?php

$invoices = $iugu->invoices()->getList();
```

### Retornando uma fatura

```php
<?php

$invoice = $iugu->invoices()->get([
    "id" => "ID_DA_FATURA"
]);
```
