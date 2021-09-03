<?php
/**La classe VHome gestisce le richieste di visualizzazione delle home page, reindirizzando al template corretto, estende View
 *
 * @access public
 * @package View
 */
class VErrore extends View
{
    /**
     * In base al nome del template passato in input, visualizza la pagia home relativa, preparandola all'occorrenza
     * @param String $nomeHomePageTemplate il nome del template da visualizzare
     * @param EUtenteInterno|EUtenteEsterno $user oggetto utente da cui recuperare i dati utente da visualizzare
     * @throws SmartyException
     */
    public function visualizzaPaginaErrore($errmex){

        $this->impostaLayout();
        $this->assign('errmex', $errmex);
        $this->display('404.tpl');
    }
}