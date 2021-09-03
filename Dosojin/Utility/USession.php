<?php
/**
 * @access public
 * @package Utility
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Classe di utilità per la gestione della sessione
 */
class USession
{
    /**
     * All'inizializzazione avvia la sessione
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * termina la sessione e camcella il cookie di sessione
     */
    public function destroy()
    {
        session_unset();
        session_destroy();
        setcookie('PHPSESSID', '',-3600);
    }

    /**
     * imposta una variabile collegata alla sessione
     *
     * @param $chiave
     * @param $valore
     */
    public function imposta_valore($chiave, $valore)
    {
        $_SESSION[$chiave] = $valore;
    }

    /**
     * elimina una variabile collegata alla sessione
     *
     * @param $chiave
     */
    public function cancella_valore($chiave)
    {
        unset($_SESSION[$chiave]);
    }

    /**
     * legge una variabile collegata alla sessione, se nessuna variabile con quel nome è stata creata restituisce false
     *
     * @param $chiave
     * @return false|mixed
     */
    public function leggi_valore($chiave)
    {
        if (isset($_SESSION[$chiave]))
            return $_SESSION[$chiave];
        else
            return false;
    }
}
