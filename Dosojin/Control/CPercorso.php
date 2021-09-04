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
     * @throws Exception
     */
    public function salvaPercorso(int $id)
    {
        if (USingleton::getInstance('USession')->leggi_valore('idUtente') != false && USingleton::getInstance('USession')->leggi_valore('tipoUtente') == 'UtenteEsterno') {
            USingleton::getInstance('FPersistentManager')->aggiungiPercorsoASalvati(USingleton::getInstance('USession')->leggi_valore('idUtente'), $id);
            USingleton::getInstance('CVisualizzaPercorso')->impostaPaginaVisualizzazione( $id);
        } else
            throw new Exception();
    }

    /**
     * rende il percorso invisibile agli altri utenti
     *
     * @param int $id l'id del percorso
     * @throws Exception
     */
    public function nascondiPercorso(int $id)
    {

        if (USingleton::getInstance('FPersistentManager')->getpercorso($id)->creatore == USingleton::getInstance('USession')->leggi_valore('idUtente')) {
            USingleton::getInstance('FPersistentManager')->nascondiPercorso($id);
            USingleton::getInstance('CUtente')->getPaginathisUtente();
        } else
            throw new Exception();
    }

    /**
     * rende il percorso visibile agli altri utenti
     *
     * @param int $id l'id del percorso
     * @throws Exception
     */
    public function mostraPercorso(int $id)
    {
        if (USingleton::getInstance('FPersistentManager')->getpercorso($id)->creatore == USingleton::getInstance('USession')->leggi_valore('idUtente')) {

            USingleton::getInstance('FPersistentManager')->mostraPercorso($id);
            USingleton::getInstance('CUtente')->getPaginathisUtente();
        } else
            throw new Exception();
    }

    /**
     * rende il percorso il seguito dall'utente
     *
     * @param int $id l'id del percorso
     * @throws Exception
     */
    public function seguiPercorso($id)
    {
        if (USingleton::getInstance('USession')->leggi_valore('idUtente') != false && USingleton::getInstance('USession')->leggi_valore('tipoUtente') == 'UtenteEsterno') {
            USingleton::getInstance('FPersistentManager')->seguiPercorso(USingleton::getInstance('USession')->leggi_valore('idUtente'), $id);
            USingleton::getInstance('CPercorsoSeguito')->getPercorsoSeguito();
        } else
            throw new Exception();
    }

    /**
     * elimina il percorso
     *
     * @param int $id l'id del percorso
     * @throws Exception
     */
    public function eliminaPercorso(int $id)
    {
        if (USingleton::getInstance('FPersistentManager')->getpercorso($id)->creatore == USingleton::getInstance('USession')->leggi_valore('idUtente')) {

            if (USingleton::getInstance('FPersistentManager')->getPercorso($id)->creatore == USingleton::getInstance('USession')->leggi_valore('idUtente')) {
                USingleton::getInstance('FPersistentManager')->eliminaPercorso($id);
                USingleton::getInstance('CUtente')->getPaginathisUtente();
            } else
                throw new Exception();

        }
    }


}