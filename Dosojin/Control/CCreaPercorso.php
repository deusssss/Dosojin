<?php

/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Controllore per la gestione della creazione di nuovi percorsi
 */
class CCreaPercorso
{
    /**
     * visualizza la pagina per la creazione di un nuovo percorso tramite la view
     *
     * @param string $errmex messaggio di errore da stampare nel caso qualcos non sia andato a buoon fine
     */
    public function getFormCreaPercorso($errmex = '')
    {

        USingleton::getInstance('VCreaPercorso')->impostaFormCrea($errmex);

    }

    /**
     * 1 - crea un nuovo oggetto di tipo percorso
     * 2 - associa al percorso gli attributi passati tramite la form di creazione del percorso
     * 3 - salva i dettagli del percorso nel cookie di sessione
     * 4 - mostra la scheda per il popolamento del percorso tramite la view
     * 5 - se il nome dl percorso esiste già per questo utente rimandalo alla form per la creazione, informandolo
     */
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

    /**
     * 1 - se l'utente ha richiesto di inserire una tappa o un trasporto crea l'oggetto associato
     * 2 - associ all'oggetto creato i parametri passati
     * 3 - controlla che la pagina non sia stata ricaricata o che l'utente non abbia inserito due volte la stessa tappa o trasporto
     * 4 - salva il nuovo oggetto nel cookie di sessione
     * 5 - imposta il form per l'aggiunta di nuovi elementi tramite la view
     *
     * @param string $errmex messaggio di errore da visualizzare all'utente
     */
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

    /**
     * controlla se la tappa aggiunta è la stessa dell'ultima aggiunta
     *
     * @param ETappa $tappa la tappa aggiunta
     * @param ETappa $lastTappa l'ultima tappa aggiunta
     * @return bool se le tappe sono uguali
     */
    private function checkReloadTappa($tappa, $lastTappa)
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

    /**
     * controlla se il trasporto aggiunto è uguale all'ultimo trasporto aggiunto
     *
     * @param ETrasporto trasporto trasporto aggiunto
     * @param ETrasporto $lastTrasporto l'ultimo trasporto aggiunto
     * @return bool se i trasporti sono uguali
     */
    private function checkReloadTrasporto($trasporto, $lastTrasporto)
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

    /**
     * 1 - recupera il percorso crato dal cookie di sessione
     * 2 - controlal che ci siano almeno due tappe, altrimenti lo segnala all'utente
     * 3 - crea il nuovo percorso nel database
     * 4 - mostra la scheda di conferma all'utente della avvenuta creazione del percorso tramite la view
     */
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