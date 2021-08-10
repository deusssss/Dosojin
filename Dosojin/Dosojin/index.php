<?php
require_once 'utility/autoload.php';
require_once 'StartSmarty.php';

 // si verifica se l'installazione è avvenuta, altrimenti viene effettuata (ramo else)
if (Installation::verificaInstallazione()){
    $fcontroller=new CFrontController();
    $fcontroller->run($_SERVER['REQUEST_URI']);
}
else
  Installation::begin();


