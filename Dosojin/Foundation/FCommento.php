<?php

/**
 * @access public
 * @package Foundation
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Class FCommento
 */
class FCommento extends FDB
{
    /**
     * 1 - richiama il costruttore di FDB
     * 2 - associa le variabili relative alla tabella
     */
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'commento';
        $this->paramNames = array('utente', 'rating', 'testo', 'percorso', 'data');
        $this->returnType = 'ECommento';
    }
}