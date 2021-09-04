<?php

/**
 *
 * @access public
 * @package View
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 */
class VHome extends View
{
    /**
     * visualizza la pagia home
     * @throws SmartyException
     */
    public function mostraPaginaHome()
    {
        $this->impostaLayout();
        $this->display('homepage.tpl');
    }
}