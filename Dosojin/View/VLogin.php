<?php
/**
 * @access public
 * @package View
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 */
class VLogin extends View
{
    /**
     * imposta la pagina di login
     *
     * @param string $errmex eventuali errori
     * @throws SmartyException
     */

    public function mostraFormLogin(string $errmex='')
    {
        $this->assign('errmex', $errmex);
        $this->display('formlogin.tpl');
    }





}