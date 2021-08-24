<?php
/**
 * @access public
 * @package Control
 */
class VLogin extends View
{

    public function mostraFormLogin($errmex='')
    {
        $this->assign('errmex', $errmex);
        $this->display('formlogin.tpl');
    }





}