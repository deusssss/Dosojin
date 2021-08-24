<?php

/**
 * Classe che modellizza un percorso come presente sul database
 */
class EPercorso
{
    /**
     * @var int $id identificativo univoco del percorso
     */
    public $id;
    /**
     * @var string $nome nome del percorso
     */
    public $nome;
    /**
     * @var EutenteEsterno $creatore il creatore del percorso
     */
    public $creatore;
    /**
     * @var int $approvato se il percorso è stato o meno approvato da un moderatore
     */
    public $approvato;
    /**
     * @var int $visibile se il percorso è visibile dagli altri utenti o solo dal proprietario e dai moderatori
     */
    public $visibile;
    /**
     * @var string $luogo il luogo in cui il percorso si trova
     */
    public $luogo;
    /**
     * @var string $descrizione una descrizione del percorso
     */
    public $descrizione;
    /**
     * @var string $periodoConsigliato il periodo consigliato in cui seguire il percorso
     */
    public $periodoConsigliato;
    /**
     * @var array $tappe la sita delle tappe che compongono il percorso
     */
    public $tappe = array();
    /**
     * @var array $trasporti la lista dei trasporti che collegano le tappe
     */
    public $trasporti = array();
    /**
     * @var array $commenti la lista dei commenti presenti sul percorso
     */
    public $commenti = array();

    /**
     * calcola il rating medio del percorso basandosi sui commenti
     *
     * @return float
     */
    public function calcolaRating()
    {
        $tot = 0;
        foreach ($this->commenti as $c) {
            $tot += $c->rating;
        }
        return $tot / count($this->commenti);
    }

    /**
     * calcola la lunghezza del viaggio basandosi sui trasporti suggeriti
     *
     * @return float
     */
    public function calcolaLunghezza()
    {
        $tot = 0;
        foreach ($this->trasporti as $t) {
            $tot += $t->lunghezza_tragitto;
        }
        return $tot;
    }

    /**
     * calcola la durata del viaggio basandosi sulla durata dei viaggi e sulla permanenza consigliata
     *
     * @return float
     */
    public function calcolaDurata()
    {
        $tot = 0;
        foreach ($this->trasporti as $t) {
            $tot += $t->durataViaggio();
        }
        foreach ($this->tappe as $t) {
            $tot += $t->permanenza_consigliata;
        }

        return $tot;
    }
}