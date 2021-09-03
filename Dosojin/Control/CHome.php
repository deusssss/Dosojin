<?php

/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * la classe CHome rappresenta il controllore delle operazioni relative alla visualizzazione della home page
 */
class CHome
{
    /**
     * 1 - controlla se l'utente è loggato (sessione attiva)
     * 2 - chiama il metodo di VHome per inviare una pagina in risposta, passa come parametro il tipo di pagina home richiesta (utente semplice/azienda, utente non registrato, moderatore/admin)
     */
    public function impostaPaginaHome()
    {

        USingleton::getInstance('VHome')->mostraPaginaHome();

    }
}