<?php

/**
 * @access public
 * @package Foundation
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Class FPercorsoSeguito
 */
class FPercorsoSeguito extends FDB
{
    /**
     * 1 - richiama il costruttore di FDB
     * 2 - associa le variabili relative alla tabella
     */
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'percorsiseguiti';
        $this->paramNames = array('ID_utente', 'ID_percorso', 'ID_tappa_corrente');
    }

    public function extractParams($obj)
    {
        $parameters = array();
        foreach ($this->paramNames as $param) {
            $parameters[$param] = $obj[$param];
        }
        return $parameters;
    }
}