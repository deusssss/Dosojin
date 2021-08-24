<?php

class FTrasporto extends FDB
{
    /**
     * 1 - richiama il costruttore di FDB
     * 2 - associa le variabili relative alla tabella
     */
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'trasporto';
        $this->paramNames = array('ID_trasporto', 'ID_percorso', 'mezzo', 'partenza', 'arrivo', 'informazioni', 'risorse', 'lunghezza_tragitto', 'ora_partenza', 'ora_arrivo',);
        $this->returnType = 'ETrasporto';
    }
}