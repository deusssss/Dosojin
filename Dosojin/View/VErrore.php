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
class VErrore extends View
{
    /**
     *
     * impost la pagina di errore
     *
     * @param string $errmex messaggio di errore
     * @throws SmartyException
     */
    public function visualizzaPaginaErrore(string $errmex, $codice){

        $this->impostaLayout();
        $this->assign('codice', $codice);
        $this->assign('errmex', $errmex);
        $this->display('errore.tpl');
    }
}