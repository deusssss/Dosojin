<?php

/**
 * @access public
 * @package Control
 */
class CVisualizzaPercorso
{

    public function impostaPaginaVisualizzazione($id, $tappa = 0, $seguito=false)
    {


        $percorso = USingleton::getInstance('FPersistentManager')->getPercorso($id);
        $sessionID = USingleton::getInstance('USession')->leggi_valore('idUtente');
        if ($sessionID != false)
            $user = USingleton::getInstance('FPersistentManager')->getUtente($sessionID, USingleton::getInstance('USession')->leggi_valore('tipoUtente'));
        else
            $user=false;
        if (($sessionID == $percorso->creatore) || ($percorso->visibile == 1 && $percorso->approvato == 1) || (($percorso->visibile == 0 && $percorso->approvato == 0) && (get_class($user) == 'EUtenteInterno') && ($user->ruolo == 'moderatore'))) {

            USingleton::getInstance('VVisualizzaPercorso')->mostraSchedaPercorso($percorso, $tappa, $seguito);
        } else
            USingleton::getInstance('CHome')->impostaPaginaHome();
    }

}