<?php

/**
 * @access public
 * @package Control
 */
class CPercorso
{

    public function salvaPercorso($id)
    {
        USingleton::getInstance('FPersistentManager')->aggiungiPercorsoASalvati(USingleton::getInstance('USession')->leggi_valore('idUtente'), $id);
        USingleton::getInstance('CUtente')->getPaginathisUtente();
    }

    public function nascondiPercorso($id)
    {
        USingleton::getInstance('FPersistentManager')->nascondiPercorso($id);
        USingleton::getInstance('CUtente')->getPaginathisUtente();
    }

    public function mostraPercorso($id)
    {
        USingleton::getInstance('FPersistentManager')->mostraPercorso($id);
        USingleton::getInstance('CUtente')->getPaginathisUtente();
    }

    public function seguiPercorso($id)
    {
        USingleton::getInstance('FPersistentManager')->seguiPercorso(USingleton::getInstance('USession')->leggi_valore('idUtente'), $id);
        USingleton::getInstance('CPercorsoSeguito')->getPercorsoSeguito();
    }

    public function eliminaPercorso($id)
    {
        if (USingleton::getInstance('FPersistentManager')->getPercorso($id)->creatore == USingleton::getInstance('USession')->leggi_valore('idUtente')) {
            USingleton::getInstance('FPersistentManager')->eliminaPercorso($id);
            USingleton::getInstance('CUtente')->getPaginathisUtente();

        }
    }


}