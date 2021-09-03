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
     */
    public function mostraPaginaHome()
    {
        $this->impostaLayout();
        $this->display('homepage.tpl');
    }
}