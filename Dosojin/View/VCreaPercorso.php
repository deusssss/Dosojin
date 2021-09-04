<?php

/**
 * @access public
 * @package View
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 */
class VCreaPercorso extends View
{
    /**
     * imposta la pagina per la creazione del percorso
     *
     * @param string $errmex
     * @throws SmartyException
     */
    public function impostaFormCrea(string $errmex)
    {
        $this->impostaLayout();
        $this->assign('errmex', $errmex);
        $this->display('formcreazionepercorso.tpl');
    }

    /**
     * imposta la pagina per l'aggiunta di tappe e trasporti
     *
     * @param EPercorso $percorso il percorso creato finora
     * @param string $errmex eventuali errori
     * @throws SmartyException
     */
    public function impostaFormEditNewPercorso(EPercorso $percorso, string $errmex)
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

    /**
     * mostra la scheda di conferma del percorso creato
     * @param int $id id del percorso
     * @throws SmartyException
     */
    public function mostraSchedaConferma(int $id)
    {
        $this->impostaLayout();
        $this->assign('id', $id);
        $this->display('confermapercorso.tpl');
    }
}