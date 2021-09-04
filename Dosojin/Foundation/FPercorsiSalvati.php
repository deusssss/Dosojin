<?php

/**
 * @access public
 * @package Foundation
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Class FPercorsiSalvati
 */
class FPercorsiSalvati extends FDB
{
    /**
     * 1 - richiama il costruttore di FDB
     * 2 - associa le variabili relative alla tabella
     */
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'percorsiSalvati';
        $this->paramNames = array('ID_utente', 'ID_percorso');
    }

    /**
     * @param  $obj
     * @return array
     */
    public function extractParams($obj): array
    {
        $parameters = array();
        foreach ($this->paramNames as $param) {
            $parameters[$param] = $obj[$param];
        }
        return $parameters;
    }
}