<?php

/**
 * @access public
 * @package Control
 */
class CCommento
{
    public function pubblicaCommento()
    {
        $commento = new Ecommento();
        $commento->utente = USingleton::getInstance('USession')->leggi_valore('idUtente');
        $commento->rating = $_POST['rating'];
        $commento->testo = $_POST['testo'];
        $commento->percorso = $_POST['percorso'];
        date_default_timezone_set('Europe/Rome');
        $commento->data = "Il " . date("Y/m/d") . ' alle ' . date('h:i');
        USingleton::getInstance('FPersistentManager')->pubblicaCommento($commento);
        USingleton::getInstance('CVisualizzaPercorso')->impostaPaginaVisualizzazione($commento->percorso,  $_POST['tappa'],  $_POST['seguito']);
    }

}