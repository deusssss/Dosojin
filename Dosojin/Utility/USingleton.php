<?php

/**
 * @access public
 * @package Utility
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 */
class USingleton
{
    /**
     * @var array $instances Array statico contenente le istanze di oggetti attivi, utile per creare una struttura singleton
     */
    private static array $instances = array();

    /**
     * Costruttore reso privato e dichiarato vuoto, in modo da restituire eccezioni se si cerca di istanziarlo direttamente.
     */
    private function __construct()
    {
        // vuoto
    }

    /**
     * Metodo statico che si occupa di restituire l'istanza univoca della classe o di istanziarne una nuova.
     */
    public static function getInstance($class)
    {
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }
        return self::$instances[$class];
    }
}