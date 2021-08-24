<?php

/** la classe CHome rappresenta il controllore delle operazioni relative alla visualizzazione della home page
 *
 * @access public
 * @package Control
 */
class CHome
{
    /**
     * 1 - controlla se l'utente è loggato (sessione attiva)
     * 2 - chiama il metodo di VHome per inviare una pagina in risposta, passa come parametro il tipo di pagina home richiesta (utente semplice/azienda, utente non registrato, moderatore/admin)
     */
    public function impostaPaginaHome()
    {
        $assign = array('logged'=>false, 'userType'=>'none','active'=>false, 'username'=>'', 'id'=>0, 'picture'=>'');
        $sessionID = USingleton::getInstance('USession')->leggi_valore('idUtente');
        if ($sessionID != false) {
            $user = USingleton::getInstance('FPersistentManager')->getUtente($sessionID);
            $assign['logged']=true;
            $assign['username']=$user->username;
            $assign['id']=$sessionID;
            $assign['picture']='Smarty/immagini/profile/'.$user->profile_picture;
            if (get_class($user) == 'EUtenteInterno') $assign['userType'] = 'interno';
            else
                if ($user->tipo == 'azienda') $assign['userType'] = 'azienda';
                else $assign['userType'] = 'esterno';
            if ($user->account_attivo == 1) $assign['active'] = true;

        }
        USingleton::getInstance('VHome')->mostraPaginaHome($assign);

    }
}