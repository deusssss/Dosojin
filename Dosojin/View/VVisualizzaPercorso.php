<?php

/**
 * @access public
 * @package View
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 */
class VVisualizzaPercorso extends View
{
    /**
     * mostra la scheda di un percorso
     * @param EPercorso $percorso
     * @param ETappa $tappa la tappa da mostrare
     * @param boolean $seguito se si tratta della tappa del percorso seguito
     * @throws SmartyException
     */
    public function mostraSchedaPercorso($percorso, $tappa, $seguito = false)
    {

        $arrayPercorso = array(
            'idPercorso' => $percorso->id,
            'nome' => $percorso->nome,
            'creatoreNome' => USingleton::getInstance('FPersistentManager')->getUtente($percorso->creatore, 'UtenteEsterno')->username,
            'creatoreId' => $percorso->creatore,
            'approvato' => $percorso->approvato,
            'visibile' => $percorso->visibile,
            'luogo' => $percorso->luogo,
            'descrizione' => $percorso->descrizione,
            'periodoConsigliato' => $percorso->periodoConsigliato,
            'tappe' => array(),
            'trasporti' => array(),
            'commenti' => array(),
            'rating' => $percorso->calcolaRating(),
            'lunghezza' => $percorso->calcolaLunghezza(),
            'durata' => $percorso->calcolaDurata()
        );
        foreach ($percorso->trasporti as $t) {
            $arrayPercorso['trasporti'][] = array(
                'mezzo' => $t->mezzo,
                'partenza' => $t->partenza,
                'arrivo' => $t->arrivo,
                'informazioni' => $t->informazioni,
                'risorse' => $t->risorse,
                'lunghezza_tragitto' => $t->lunghezza_tragitto,
                'ora_partenza' => $t->ora_partenza,
                'ora_arrivo' => $t->ora_arrivo,
                'durataViaggio' => $t->durataViaggio());
        }
        $t = $percorso->tappe[$tappa];

        $arrayPercorso['tappe'] = array(
            'ID_tappa' => $t->ID_tappa,
            'ID_percorso' => $t->ID_percorso,
            'nome' => $t->nome,
            'indirizzo' => $t->indirizzo,
            'permanenza_consigliata' => $t->permanenza_consigliata,
            'informazioni' => $t->informazioni,
            'risorse' => $t->risorse);

        $nomiTappe = array();

        foreach ($percorso->tappe as $t)
            $nomiTappe[] = $t->nome;

        foreach ($percorso->commenti as $t) {
            $arrayPercorso['commenti'][] = array(
                'id' => $t->id,
                'idUtente' => $t->utente,
                'nomeUtente' => USingleton::getInstance('FPersistentManager')->getUtente($t->utente, 'UtenteEsterno')->username,
                'rating' => $t->rating,
                'testo' => $t->testo,
                'data' => $t->data,
                'propic' => 'Smarty/immagini/profile/' . USingleton::getInstance('FPersistentManager')->getUtente($t->utente, 'UtenteEsterno')->profile_picture);
        }


        foreach ($arrayPercorso as $key => $value)
            $this->assign($key, $value);
        $this->assign('seguito', $seguito);
        $this->impostaLayout();
        $this->assign('nomiTappe', $nomiTappe);
        $this->display('visualizzapercorso.tpl');
    }


}