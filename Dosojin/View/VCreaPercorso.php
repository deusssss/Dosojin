<?php

/**
 * @access public
 * @package View
 */
class VCreaPercorso extends View
{
    public function impostaFormCrea($errmex)
    {
        $this->impostaLayout();
        $this->assign('errmex', $errmex);
        $this->display('formcreazionepercorso.tpl');
    }

    public function impostaFormEditNewPercorso($percorso, $errmex)
    {
        $arrayTappe = array();
        $arrayTrasporti = array();
        foreach ($percorso->tappe as $t)
            $arrayTappe[] = array(
                'ID_tappa' => $t->ID_tappa,
                'nome' => $t->nome,
                'indirizzo' => $t->indirizzo,
                'permanenzaConsigliata' => $t->permanenza_consigliata,
                'informazioni' => $t->informazioni,
                'risorse' => $t->risorse);

        foreach ($percorso->trasporti as $t)
            $arrayTrasporti[] = array(
                'mezzo' => $t->mezzo,
                'partenza' => $t->partenza,
                'arrivo' => $t->arrivo,
                'informazioni' => $t->informazioni,
                'risorse' => $t->risorse,
                'ora_partenza' => $t->ora_partenza,
                'ora_arrivo' => $t->ora_arrivo,
                'lunghezza_tragitto' => $t->lunghezza_tragitto
            );
        foreach ($percorso->trasporti as $tr)
            foreach ($percorso->tappe as $ta) {
                if ($tr->partenza == $ta->ID_tappa)
                    $tr->partenza = $ta->nome;
                if ($tr->arrivo == $ta->ID_tappa)
                    $tr->arrivo = $ta->nome;
            }
        $this->impostaLayout();
        $this->assign('errmex', $errmex);
        $this->assign('tappe', $arrayTappe);
        $this->assign('trasporti', $arrayTrasporti);
        $this->display('formeditpercorso.tpl');

    }

    public function mostraSchedaConferma($id)
    {
        $this->impostaLayout();
        $this->assign('id', $id);
        $this->display('confermapercorso.tpl');
    }
}