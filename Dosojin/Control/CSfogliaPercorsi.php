<?php

/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Controllore responsabile della visualizzazione di elenchi di percorsi
 */
class CSfogliaPercorsi
{
    /**
     * recupera tutti i percorsi e li visualizza tramite la view
     */
    public function sfogliaPercorsi()
    {
        $filtro = array();
        $ordinamento = array();
        if (isset($_POST['filtro']) && $_POST['valore'] != '') {
            $filtro = array($_POST['filtro'] => $_POST['valore']);
        }
        if (isset($_POST['ordinamento'])) {
            $ordinamento = array($_POST['ordinamento']);
        }

        $percorsi = USingleton::getInstance('FPersistentManager')->getAllPercorsi($filtro, $ordinamento);
        USingleton::getInstance('VSfogliaPercorsi')->impostaPaginaSfoglia($percorsi);
    }

    /**
     * recupera tutti i percorsi salvati dall'utente e li visualizza tramite la view
     *
     * @param int $id
     */
    public function getPercorsiSalvati(int $id)
    {
        $sessionID = USingleton::getInstance('USession')->leggi_valore('idUtente');
        if ($sessionID != false) {
            $percorsi = USingleton::getInstance('FPersistentManager')->getPercorsiSalvati($id);
            USingleton::getInstance('VSfogliaPercorsi')->impostaPaginaSfoglia($percorsi, true);
        } else
            USingleton::getInstance('CHome')->impostaPaginaHome();
    }


}