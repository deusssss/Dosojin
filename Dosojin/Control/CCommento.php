<?php

/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Controllore per la pubblicazione dei commenti
 */
class CCommento
{
    /**
     * 1 - crea un nuovo oggetto della classe commento
     * 2 - associa i parametri inviati al commento creato
     * 3 - inserisci il commento nel database tramite il FM
     * 4 - visualizza la pagina di visualizzazione del percorso con il nuovo commento tramite la vIew
     * @throws Exception
     */
    public function pubblicaCommento()
    {
        if ((USingleton::getInstance('USession')->leggi_valore('idUtente') != false)) {
            $commento = new Ecommento();
            $commento->utente = USingleton::getInstance('USession')->leggi_valore('idUtente');
            $commento->rating = $_POST['rating'];
            $commento->testo = $_POST['testo'];
            $commento->percorso = $_POST['percorso'];
            date_default_timezone_set('Europe/Rome');
            $commento->data = "Il " . date("Y/m/d") . ' alle ' . date('h:i');
            USingleton::getInstance('FPersistentManager')->pubblicaCommento($commento);
            USingleton::getInstance('CVisualizzaPercorso')->impostaPaginaVisualizzazione($commento->percorso, $_POST['tappa'], $_POST['seguito']);
        }else
            throw new Exception();
    }

}