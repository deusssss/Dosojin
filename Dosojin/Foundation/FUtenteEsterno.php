<?php

/**
 * @access public
 * @package Foundation
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Class FUtenteEsterno
 */
class FUtenteEsterno extends FDB
{
    /**
     * 1 - richiama il costruttore di FDB
     * 2 - associa le variabili relative alla tabella
     */
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'utenteEsterno';
        $this->paramNames = array('username', 'password', 'email', 'data_iscrizione', 'account_attivo', 'nome', 'cognome', 'informazioni', 'tipo', 'profile_picture');
        $this->returnType = 'EUtenteEsterno';
    }
}