<?php
/**
 * @access public
 * @package Utility
 */
class USession
{
    public function __construct()
    {
        session_start();
    }
    public function destroy()
    {
        session_unset();
        session_destroy();
        setcookie('PHPSESSID', '',-3600);
    }
    public function imposta_valore($chiave, $valore)
    {
        $_SESSION[$chiave] = $valore;
    }

    public function cancella_valore($chiave)
    {
        unset($_SESSION[$chiave]);
    }

    public function leggi_valore($chiave)
    {
        if (isset($_SESSION[$chiave]))
            return $_SESSION[$chiave];
        else
            return false;
    }
}
