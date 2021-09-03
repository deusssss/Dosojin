<?php
/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Controllore responsabile del logout
 */
class CLogout{
    /**
     * elimina la sessione e rimanda alla home
     */
    public function logout(){
        USingleton::getInstance('USession')->destroy();
        USingleton::getInstance('CHome')->impostaPaginaHome();

    }
}