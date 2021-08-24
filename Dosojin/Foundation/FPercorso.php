<?php

class FPercorso extends FDB
{
    /**
     * 1 - richiama il costruttore di FDB
     * 2 - associa le variabili relative alla tabella
     */
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'percorso';
        $this->paramNames = array('nome', 'creatore', 'approvato', 'visibile', 'luogo', 'descrizione', 'periodoConsigliato');
        $this->returnType = 'EPercorso';
    }
}