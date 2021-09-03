<?php

/**
 * @access public
 * @package View
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 */
class VSfogliaPercorsi extends View
{
    /**
     * imposta la pagina contente tutti i percorsi, o i percorsi salvati di un utente
     *
     * @param array $percorsi la lista di percorsi da mostrare
     * @param boolean $salvati se si tratta di una lista di percorsi salvati
     * @throws SmartyException
     */
    public function impostaPaginaSfoglia($percorsi, $salvati = false)
    {
        $percorsiArray = array();
        foreach ($percorsi as $p)
            $percorsiArray[] = array(
                'id' => $p->id,
                'nome' => $p->nome,
                'creatore' => USingleton::getInstance('FPersistentManager')->getUtente($p->creatore, 'UtenteEsterno')->username,
                'luogo' => $p->luogo,
                'lunghezza' => $p->calcolaLunghezza(),
                'rating' => $p->calcolaRating(),
                'idCreatore' => $p->creatore,
                'tappe' => count($p->tappe),
                'trasporti' => count($p->trasporti),
                'periodoConsigliato' => $p->periodoConsigliato);
        $this->assign('salvati', $salvati);
        $this->impostaLayout();
        $this->assign('percorsi', $percorsiArray);
        $this->display('sfogliapercorsi.tpl');
    }


}
