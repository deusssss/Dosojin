<?php

class FUtenteInterno extends FDB
{
    /**
     * 1 - richiama il costruttore di FDB
     * 2 - associa le variabili relative alla tabella
     */
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'utenteInterno';
        $this->paramNames = array('username', 'password', 'email', 'account_attivo', 'ruolo', 'profile_picture');
        $this->returnType = 'EUtenteInterno';
    }
}