<?php

/**
 * @access public
 * @package Control
 */
class CPercorsoSeguito
{

    public function getPercorsoSeguito(){
        $percorsoSeguito=USingleton::getInstance('FPersistentManager')->getPercorsoSeguito(USingleton::getInstance('USession')->leggi_valore('idUtente'));
        if($percorsoSeguito!=false)
        USingleton::getInstance('CVisualizzaPercorso')->impostaPaginaVisualizzazione($percorsoSeguito['percorso']->id, $percorsoSeguito['tappa'], true);
        else
            USingleton::getInstance('CHome')->impostaPaginaHome();
    }
    public function prossimaTappa(){
        USingleton::getInstance('FPersistentManager')->prossimaTappaSeguito(USingleton::getInstance('USession')->leggi_valore('idUtente'));
        $this->getPercorsoSeguito();
    }

}