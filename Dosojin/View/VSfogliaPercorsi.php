<?php

/**
 * @access public
 * @package View
 */
class VSfogliaPercorsi extends View
{
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
