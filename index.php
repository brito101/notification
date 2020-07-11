<?php

require __DIR__ . '/lib_ext/autoload.php';

use Notification\Email;

$novoEmail = new Email;
$novoEmail->sendEmail("Teste", "<p>Texto</p>", "rodrigobrito101@hotmail.com", "Rodrigo Brito", "rodrigobrito101@gmail.com", "Rodrigo");

var_dump($novoEmail);
