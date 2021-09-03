<?php

require_once 'Config/autoload.inc.php';                 //autoloader
require_once 'Config/config.inc.php';
$FC = USingleton::getInstance('CFrontController'); //invocazione del frontcontroller
$FC->smista();                                          //smistamento delle richieste