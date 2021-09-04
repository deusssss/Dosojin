<?php

/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Controllore responsabile della visualizzazione di un singolo percorso
 */
class CVisualizzaPercorso
{
    /**
     * 1 - recupera il percorso richiesto
     * 2 - lo visualizza tramite la view
     *
     * @param int $id id del percorso
     * @param int $tappa id della tappa da mostrare
     * @param false $seguito se il percorso visualizzato è il seguito
     */
    public function impostaPaginaVisualizzazione(int $id, int $tappa = 0, bool $seguito = false)
    {


        $percorso = USingleton::getInstance('FPersistentManager')->getPercorso($id);
        $sessionID = USingleton::getInstance('USession')->leggi_valore('idUtente');
        if ($sessionID != false)
            $user = USingleton::getInstance('FPersistentManager')->getUtente($sessionID, USingleton::getInstance('USession')->leggi_valore('tipoUtente'));
        else
            $user = false;
        if (($sessionID == $percorso->creatore) || ($percorso->visibile == 1 && $percorso->approvato == 1) || (($percorso->visibile == 0 && $percorso->approvato == 0) && (get_class($user) == 'EUtenteInterno') && ($user->ruolo == 'moderatore'))) {

            USingleton::getInstance('VVisualizzaPercorso')->mostraSchedaPercorso($percorso, $tappa, $seguito);
        } else
            USingleton::getInstance('CHome')->impostaPaginaHome();
    }

}