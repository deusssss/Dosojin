<?php

/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Controllore responsabile della gestione dei percorsi seguiti
 */
class CPercorsoSeguito
{
    /**
     * visualizza il percorso seguito dall'utente  tramite la view
     */
    public function getPercorsoSeguito(){
        $percorsoSeguito=USingleton::getInstance('FPersistentManager')->getPercorsoSeguito(USingleton::getInstance('USession')->leggi_valore('idUtente'));
        if($percorsoSeguito!=false)
        USingleton::getInstance('CVisualizzaPercorso')->impostaPaginaVisualizzazione($percorsoSeguito['percorso']->id, $percorsoSeguito['tappa'], true);
        else
            USingleton::getInstance('CHome')->impostaPaginaHome();
    }

    /**
     * sposta la tappa del percorso seguito alla prossima e la visualizza
     */
    public function prossimaTappa(){
        USingleton::getInstance('FPersistentManager')->prossimaTappaSeguito(USingleton::getInstance('USession')->leggi_valore('idUtente'));
        $this->getPercorsoSeguito();
    }

}