<?php
/**
 * @access public
 * @package Control
 */
class VRegistrazione extends View
{

    public function mostraFormRegistrazione($errmex='',$mod=false)
    {
        $this->assign('mod',$mod);
        $this->assign('error', $errmex);
        $this->display('formregistrazione.tpl');
    }





}