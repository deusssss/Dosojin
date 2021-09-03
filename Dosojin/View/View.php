<?php
require('Smarty/libs/Smarty.class.php');
/**
 * La classe view estende il template Engine Smarty e funge da punto di partenza per tutte le altre classi nel package view
 *
 * @access public
 * @package View
 */
class View extends Smarty
{
    public function __construct()
    {
        parent::__construct();
        global $config;
        $this->template_dir = $config['smarty']['template_dir'];
        $this->compile_dir = $config['smarty']['compile_dir'];
        $this->config_dir = $config['smarty']['config_dir'];
        $this->cache_dir = $config['smarty']['cache_dir'];
        $this->caching = false;
    }
    public function impostaLayout(){
        $sessionID = USingleton::getInstance('USession')->leggi_valore('idUtente');
        $assign = array('logged' => false, 'userType' => 'utente', 'username' => '', 'idUtente' => 0, 'picture' => '', 'attivo'=>0);
        if ($sessionID != false) {
            $user = USingleton::getInstance('FPersistentManager')->getUtente($sessionID, USingleton::getInstance('USession')->leggi_valore('tipoUtente'));
            if ($user != false) {
                $assign['logged'] = true;
                $assign['username'] = $user->username;
                $assign['idUtente'] = $sessionID;
                $assign['picture'] = 'Smarty/immagini/profile/' . $user->profile_picture;
                $assign['attivo'] = $user->account_attivo;
                if (get_class($user)=='EUtenteInterno')
                    $assign['userType'] = 'interno';
                else if ($user->tipo == 'azienda') $assign['userType'] = 'azienda';
            }
        }
        foreach($assign as $key=>$value){
            $this->assign($key, $value);
        }
    }
}