# Introdução

Essa SDK foi construída com o intuito de torná-la flexível, de forma que todos possam utilizar todas as features, de todas as versões de API.

Você pode acessar a documentação oficial da Iugu acessando esse [link](https://dev.iugu.com/).

## Índice

- [Instalação](#instalação)
- [Configuração](#configuração)
- [Clientes](#clientes)
  - [Criando um cliente](#criando-um-cliente)
  - [Retornando clientes](#retornando-clientes)
  - [Retornando um cliente](#retornando-um-cliente)

## Instalação

Instale a biblioteca utilizando o comando

`composer require igorsamaral/iugu-php`

## Configuração

Para incluir a biblioteca em seu projeto, basta fazer o seguinte:

```php
<?php
require('vendor/autoload.php');

$iugu = new Iugu\Client('SUA_CHAVE_DE_API');
```

### Definindo headers customizados

1. Se necessário for é possível definir headers http customizados para os requests. Para isso basta informá-los durante a instanciação do objeto `Client`:

```php
<?php
require('vendor/autoload.php');

$iugu = new iugu\Client(
    'SUA_CHAVE_DE_API',
    ['headers' => ['MEU_HEADER_CUSTOMIZADO' => 'VALOR HEADER CUSTOMIZADO']]
); 
```

E então, você pode poderá utilizar o cliente para fazer requisições ao Iugu.com.br, como nos exemplos abaixo.
## Clientes

Clientes representam os usuários de sua loja, ou negócio. Este objeto contém informações sobre eles, como nome, e-mail e telefone, além de outros campos.

### Criando um cliente

```php
<?php
$customer = $iugu->customers()->create([
    'email' => 'joao.neves@email.com',
    'name' => 'João das Neves',
    'notes' => 'lorem...',
    'phone' => '998894321',
    'phone_prefix' => '11',
    'cpf_cnpj' => '11743685009',
    'zip_code' => '76814112',
    'number' => '100',
    'street' => 'Rua Cabedelo',
    'city' => 'Porto Velho',
    'state' => 'RO',
    'district' => 'Marcos Freire',
    'complement' => 'complemento...',
    'custom_variables' => [
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
    'id' => 'ID_DO_CLIENTE'
]);
```
