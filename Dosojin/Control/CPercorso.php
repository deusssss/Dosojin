<?php

/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Controllore responsabile delle perazioni sui percorsi
 */
class CPercorso
{
    /**
     * aggiunge il percorso ai salvati dell'utente
     *
     * @param int $id l'id del percorso
     */
    public function salvaPercorso(int $id)
    {
        USingleton::getInstance('FPersistentManager')->aggiungiPercorsoASalvati(USingleton::getInstance('USession')->leggi_valore('idUtente'), $id);
        USingleton::getInstance('CUtente')->getPaginathisUtente();
    }

    /**
     * rende il percorso invisibile agli altri utenti
     *
     * @param int $id l'id del percorso
     */
    public function nascondiPercorso(int $id)
    {
        USingleton::getInstance('FPersistentManager')->nascondiPercorso($id);
        USingleton::getInstance('CUtente')->getPaginathisUtente();
    }

    /**
     * rende il percorso visibile agli altri utenti
     *
     * @param int $id l'id del percorso
     */
    public function mostraPercorso(int $id)
    {
        USingleton::getInstance('FPersistentManager')->mostraPercorso($id);
        USingleton::getInstance('CUtente')->getPaginathisUtente();
    }

    /**
     * rende il percorso il seguito dall'utente
     *
     * @param int $id l'id del percorso
     */
    public function seguiPercorso($id)
    {
        USingleton::getInstance('FPersistentManager')->seguiPercorso(USingleton::getInstance('USession')->leggi_valore('idUtente'), $id);
        USingleton::getInstance('CPercorsoSeguito')->getPercorsoSeguito();
    }

    /**
     * elimina il percorso
     *
     * @param int $id l'id del percorso
     */
    public function eliminaPercorso(int $id)
    {
        if (USingleton::getInstance('FPersistentManager')->getPercorso($id)->creatore == USingleton::getInstance('USession')->leggi_valore('idUtente')) {
            USingleton::getInstance('FPersistentManager')->eliminaPercorso($id);
            USingleton::getInstance('CUtente')->getPaginathisUtente();

        }
    }


}