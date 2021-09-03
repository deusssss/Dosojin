<?php

/**
 * @access public
 * @package View
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 */
class VRegistrazione extends View
{
    /**mostra il form per la registrazione
     *
     * @param string $errmex eventuai errori
     * @param boolean $mod se la pagina richiesta è quella di registrazione per moderatori
     * @throws SmartyException
     */
    public function mostraFormRegistrazione($errmex = '', $mod = false)
    {
        $this->assign('mod', $mod);
        $this->assign('error', $errmex);
        $this->display('formregistrazione.tpl');
    }


}