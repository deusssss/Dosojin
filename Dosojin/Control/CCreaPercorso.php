<?php

/**
 * @access public
 * @package Control
 */
class CCreaPercorso
{
    public function getFormCreaPercorso($errmex = '')
    {

        USingleton::getInstance('VCreaPercorso')->impostaFormCrea($errmex);

    }

    public function getFormEditPercorso()
    {

        $sessionID = USingleton::getInstance('USession')->leggi_valore('idUtente');
        if (USingleton::getInstance('FPersistentManager')->EsisteNomePercorso($sessionID, $_POST['nome']) == false) {
            $percorso = new EPercorso;
            $percorso->nome = $_POST['nome'];
            $percorso->creatore = USingleton::getInstance('USession')->leggi_valore('idUtente');
            $percorso->luogo = $_POST['luogo'];
            $percorso->descrizione = $_POST['descrizione'];
            $percorso->periodoConsigliato = $_POST['periodoConsigliato'];
            $percorso->approvato = 0;
            $percorso->visibile = 0;
            $percorso->tappe = array();
            $percorso->trasporti = array();
            $percorso->commenti = array();
            USingleton::getInstance('USession')->imposta_valore("percorso creato", $percorso);
            $this->editNewPercorso();
        } else
            $this->getFormCreaPercorso('Un percorso con questo nome è già associato al tuo account, per favore scegline un altro');
    }

    public function editNewPercorso($errmex = '')
    {

        $percorso = USingleton::getInstance('USession')->leggi_valore('percorso creato');
        if ($_POST['add'] == 'tappa') {
            $newTappa = new ETappa();
            $newTappa->ID_tappa = count($percorso->tappe);
            $newTappa->nome = $_POST['nome'];
            $newTappa->indirizzo = $_POST['indirizzo'];
            $newTappa->permanenza_consigliata = $_POST['permanenzaConsigliata'];
            $newTappa->informazioni = $_POST['informazioni'];
            $newTappa->risorse = $_POST['risorse'];
            if ($this->checkReloadTappa($newTappa, end($percorso->tappe)))
                $percorso->tappe[] = $newTappa;
        } else if ($_POST['add'] == 'trasporto') {
            $newTrasporto = new ETrasporto;
            $newTrasporto->mezzo = $_POST['mezzo'];
            $newTrasporto->ID_trasporto = count($percorso->trasporti);
            $newTrasporto->partenza = $_POST['partenza'];
            $newTrasporto->arrivo = $_POST['arrivo'];
            $newTrasporto->informazioni = $_POST['informazioni'];
            $newTrasporto->risorse = $_POST['risorse'];
            $newTrasporto->ora_partenza = $_POST['ora_partenza'];
            $newTrasporto->ora_arrivo = $_POST['ora_arrivo'];
            $newTrasporto->lunghezza_tragitto = floatval($_POST['lunghezza_tragitto']);

            if ($this->checkReloadTrasporto($newTrasporto, end($percorso->trasporti)))
                $percorso->trasporti[] = $newTrasporto;
        }

        USingleton::getInstance('VCreaPercorso')->impostaFormEditNewPercorso($percorso, $errmex);

    }

    public function checkReloadTappa($tappa, $lastTappa)
    {
        if ($tappa->nome != $lastTappa->nome)
            return true;
        else if ($tappa->indirizzo != $lastTappa->indirizzo)
            return true;
        else if ($tappa->permanenza_consigliata != $lastTappa->permanenza_consigliata)
            return true;
        else if ($tappa->informazioni != $lastTappa->informazioni)
            return true;
        else if ($tappa->risorse != $lastTappa->risorse)
            return true;
        else
            return false;
    }

    public function checkReloadTrasporto($trasporto, $lastTrasporto)
    {
        if ($trasporto->mezzo != $lastTrasporto->mezzo)
            return true;
        else if (is_int($trasporto->partenza))
            return true;
        else if (is_int($trasporto->arrivo))
            return true;
        else if ($trasporto->informazioni != $lastTrasporto->informazioni)
            return true;
        else if ($trasporto->risorse != $lastTrasporto->risorse)
            return true;
        else if ($trasporto->ora_partenza != $lastTrasporto->ora_partenza)
            return true;
        else if ($trasporto->ora_arrivo != $lastTrasporto->ora_arrivo)
            return true;
        else if ($trasporto->lunghezza_tragitto != $lastTrasporto->lunghezza_tragitto)
            return true;
        else
            return false;
    }

    public function crea()
    {
        $percorso = USingleton::getInstance('USession')->leggi_valore('percorso creato');

        if (count($percorso->tappe) < 2)
            $this->editNewPercorso('Inserisci almeno due tappe');
        else {
            $percorsoID = USingleton::getInstance('FPersistentManager')->nuovoPercorso($percorso);

            USingleton::getInstance('USession')->cancella_valore('percorso creato');
            USingleton::getInstance('VCreaPercorso')->mostraSchedaConferma($percorsoID);
        }
    }


}