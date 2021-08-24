<?php

/**
 * La classe CFrontController rappresenta l'omonimo strumento, un pannello di interazione attrverso il quale main.php può efficacemente gestire le richieste smistandole per controller e task
 *
 * @access public
 * @package Control
 */
class CFrontController
{
    /**
     * Smista le richieste ai vari controller, i quali gestiscono la task in base alle varie situazioni
     * nel caso di una richiesta senza controllore, o con controllore/task inesistente reindirizza alla home page
     *
     */
    public function smista()
    {
        $c = $this->getController();
        if (!$c)
            USingleton::getInstance('CHome')->impostaPaginaHome();
        else
            try {
                USingleton::getInstance('C' . $this->getController())->smista();
            } catch (Error ) {
                USingleton::getInstance('CHome')->impostaPaginaHome();
            }
    }

    /**
     * restituisce il controller passato tramite la richiesta GET o POST
     * restituisce false nel caso nessun controller sia stato richiesto
     *
     * @return false|string
     */
    public
    function getController()
    {
        if (isset($_REQUEST['controller']))
            return $_REQUEST['controller'];
        else
            return false;
    }


}
