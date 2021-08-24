<?php

require_once 'Config/autoload.inc.php';                 //autoloader
require_once 'Config/config.inc.php';                   //assegnazione variabile globale di configurazione

$FC = USingleton::getInstance('CFrontController'); //invocazione del frontcontroller
$FC->smista();                                          //smistamento delle richieste