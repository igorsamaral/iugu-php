<?php

use Iugu\Client;

require __DIR__ . '/vendor/autoload.php';

$iugu = new Client('962d9cb4513b9569c7423e5074a4886d');
$customers = $iugu->customers()->getList();

var_dump($customers);
