<?php

/**
 * @access public
 * @package Control
 */
class CLogin
{
    /**
     * chiama la view che restituisce il form di login all'utente
     */
    public function getLoginForm()
    {
        USingleton::getInstance('VLogin')->mostraFormLogin();
    }

    /**
     * 1 - controlla che le credenziali inserite dall'utente siano valide, altrimenti restituisce false
     * 2 - inserisce l'id dell'utente nella variabile di sessione, rendendola effettivamente attiva
     * 3 - reindirizza alla home page
     */
    public function autentica()
    {
        $user=USingleton::getInstance('FPersistentManager')->logUtente($_REQUEST['username'], hash('md5', $_REQUEST['password']));
        if ($user!=false) {
            USingleton::getInstance('USession')->imposta_valore('id', $user->id);
            USingleton::getInstance('CHome')->impostaPaginaHome();
        }
         else {
            USingleton::getInstance('VLogin')->mostraFormLogin('utente non trovato');
        }
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