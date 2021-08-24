<?php

class FTappa extends FDB
{
    /**
     * 1 - richiama il costruttore di FDB
     * 2 - associa le variabili relative alla tabella
     */
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'tappa';
        $this->paramNames = array('ID_tappa', 'ID_percorso', 'nome', 'indirizzo', 'permanenza_consigliata', 'informazioni', 'risorse');
        $this->returnType='ETappa';
    }
}