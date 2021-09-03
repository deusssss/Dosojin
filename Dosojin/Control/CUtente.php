<?php

/**
 * @access public
 * @package Control
 */
class CUtente
{
    public function getPaginaUtente($id, $int = false)
    {
        if ($int)
            $user = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteInterno');
        else
            $user = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteEsterno');
        $percorsiCreati = USingleton::getInstance('FPersistentManager')->getPercorsiDiUtente($id);
        USingleton::getInstance('VUtente')->mostraPaginaUtente($user, $percorsiCreati);
    }

    public function getPaginathisUtente()
    {
        if (USingleton::getInstance('USession') != false) {
            $user = USingleton::getInstance('FPersistentManager')->getUtente(USingleton::getInstance('USession')->leggi_valore('idUtente'), USingleton::getInstance('USession')->leggi_valore('tipoUtente'));
            $percorsiCreati = USingleton::getInstance('FPersistentManager')->getPercorsiDiUtente(USingleton::getInstance('USession')->leggi_valore('idUtente'));
            USingleton::getInstance('VUtente')->mostraPaginaUtente($user, $percorsiCreati);
        } else
            USingleton::getInstance('CHome')->impostaPaginaHome();
    }

    public function aggiornaImmagineProfilo()
    {
        $user = USingleton::getInstance('FPersistentManager')->getUtente(USingleton::getInstance('USession')->leggi_valore('idUtente'), USingleton::getInstance('USession')->leggi_valore('tipoUtente'));
        $user->profile_picture = 'ProPic_' . $user->username . '.png';
        move_uploaded_file($_FILES["immagine"]['tmp_name'], 'Smarty/immagini/profile/ProPic_' . $user->username . '.png');
        USingleton::getInstance('FPersistentManager')->aggiornaUtente($user);
        $this->getPaginathisUtente();
    }

    public function aggiornaInfoProfilo()
    {
        $user = USingleton::getInstance('FPersistentManager')->getUtente(USingleton::getInstance('USession')->leggi_valore('idUtente'), USingleton::getInstance('USession')->leggi_valore('tipoUtente'));
        $user->informazioni = $_POST['informazioni'];
        USingleton::getInstance('FPersistentManager')->aggiornaUtente($user);
        $this->getPaginathisUtente();

    }

}