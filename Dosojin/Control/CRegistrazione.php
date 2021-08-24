<?php

/**
 * @access public
 * @package Control
 */
class CRegistrazione
{

    public function getSignUpForm()
    {
        USingleton::getInstance('VRegistrazione')->mostraFormRegistrazione();
    }

    public function valutaRichiesta()
    {

    }


    /**
     * Smista le richieste al metodo richiesto della classe
     * rimanda alla home se è stato richiesto un metodo inesistente o se c'è una sessione attiva
     *
     * @return void
     */
    public function smista()
    {
        if (!USingleton::getInstance('USession')->leggi_valore('idUtente'))
            try {
                $task = $this->getTask();
                $this->$task();
            } catch (Error) {
                USingleton::getInstance('CHome')->impostaPaginaHome();
            }
        else
            USingleton::getInstance('CHome')->impostaPaginaHome();
    }

    /**
     * restituisce il task passato tramite la richiesta GET o POST
     * restituisce false nel caso nessun task sia stato richiesto
     *
     * @return false|string
     */
    public function getTask(): bool|string
    {
        if (isset($_REQUEST['task']))
            return $_REQUEST['task'];
        else
            return false;
    }
}