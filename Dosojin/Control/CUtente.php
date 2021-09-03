<?php

/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Controllore responsabile della gestione della pagina utente
 */
class CUtente
{
    /**
     * visualizza la pagina dell'utente richiesto tramita la view
     *
     * @param int $id l'id dell'utente
     * @param false $int se si tratta di un utente interno
     */
    public function getPaginaUtente($id, $int = false)
    {
        if ($int)
            $user = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteInterno');
        else
            $user = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteEsterno');
        $percorsiCreati = USingleton::getInstance('FPersistentManager')->getPercorsiDiUtente($id);
        USingleton::getInstance('VUtente')->mostraPaginaUtente($user, $percorsiCreati);
    }

    /**
     * visualizza la pagina dell'utente loggato tramite la view
     */
    public function getPaginathisUtente()
    {
        if (USingleton::getInstance('USession') != false) {
            $user = USingleton::getInstance('FPersistentManager')->getUtente(USingleton::getInstance('USession')->leggi_valore('idUtente'), USingleton::getInstance('USession')->leggi_valore('tipoUtente'));
            $percorsiCreati = USingleton::getInstance('FPersistentManager')->getPercorsiDiUtente(USingleton::getInstance('USession')->leggi_valore('idUtente'));
            USingleton::getInstance('VUtente')->mostraPaginaUtente($user, $percorsiCreati);
        } else
            USingleton::getInstance('CHome')->impostaPaginaHome();
    }

    /**
     * 1 - aggiorna l'immagine del profilo dell'utente
     * 2 - salva la nuova immagine del profilo
     */
    public function aggiornaImmagineProfilo()
    {
        $user = USingleton::getInstance('FPersistentManager')->getUtente(USingleton::getInstance('USession')->leggi_valore('idUtente'), USingleton::getInstance('USession')->leggi_valore('tipoUtente'));
        $user->profile_picture = 'ProPic_' . $user->username . '.png';
        move_uploaded_file($_FILES["immagine"]['tmp_name'], 'Smarty/immagini/profile/ProPic_' . $user->username . '.png');
        USingleton::getInstance('FPersistentManager')->aggiornaUtente($user);
        $this->getPaginathisUtente();
    }

    /**
     * aggiorna la informazioni del profilo dell'utente
     */
    public function aggiornaInfoProfilo()
    {
        $user = USingleton::getInstance('FPersistentManager')->getUtente(USingleton::getInstance('USession')->leggi_valore('idUtente'), USingleton::getInstance('USession')->leggi_valore('tipoUtente'));
        $user->informazioni = $_POST['informazioni'];
        USingleton::getInstance('FPersistentManager')->aggiornaUtente($user);
        $this->getPaginathisUtente();

    }

}