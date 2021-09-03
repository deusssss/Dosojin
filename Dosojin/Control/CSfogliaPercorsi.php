<?php

/**
 * @access public
 * @package Control
 */
class CSfogliaPercorsi
{
//TODO
    public function sfogliaPercorsi()
    {
        $filtro=array();
        $ordinamento=array();
        if (isset($_POST['filtro']) && $_POST['valore']!=''){
            $filtro=array($_POST['filtro']=>$_POST['valore']);
        }
        if (isset($_POST['ordinamento'])){
            $ordinamento=array($_POST['ordinamento']);
        }

        $percorsi = USingleton::getInstance('FPersistentManager')->getAllPercorsi($filtro, $ordinamento);
        USingleton::getInstance('VSfogliaPercorsi')->impostaPaginaSfoglia($percorsi);
    }

    public
    function getPercorsiSalvati($id)
    {
        $sessionID = USingleton::getInstance('USession')->leggi_valore('idUtente');
        if ($sessionID != false) {
            $percorsi = USingleton::getInstance('FPersistentManager')->getPercorsiSalvati($id);
            USingleton::getInstance('VSfogliaPercorsi')->impostaPaginaSfoglia($percorsi, true);
        } else
            USingleton::getInstance('CHome')->impostaPaginaHome();
    }


}