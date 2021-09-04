<?php

class ETrasporto
{
    /**
     * @var int $ID_trasporto progressivo del trasporto nel percorso
     */
    public $ID_trasporto;
    /**
     * @var int $ID_percorso identificativo del percorso relativo al trasporto
     */
    public $ID_percorso;
    /**
     * @var string $mezzo mezzo di trasporto
     */
    public $mezzo;
    /**
     * @var int $partenza la tappa di partenza
     */
    public$partenza;
    /**
     * @var int $arrivo la tappa di arrivo
     */
    public $arrivo;
    /**
     * @var string $informazioni informazioni aggiuntive sul trasporto
     */
    public $informazioni;
    /**
     * @var string $risorse risorse utili come link a siti web ed indirizzi
     */
    public $risorse;
    /**
     * @var double $lunghezza_tragitto la lunghezza dl tragitto, espressa in kilometri
     */
    public $lunghezza_tragitto;
    /**@
     * @var string $ora_partenza l'orario consigliato di partenza
     */
    public $ora_partenza;
    /**
     * @var string $ora_arrivo l'orario previsto di arrivo se partiti nell'ora di partenza consigliata
     */
    public $ora_arrivo;

    public function durataViaggio()
    {
        return (new DateTime($this->ora_arrivo))->diff(new DateTime($this->ora_partenza))->format('%h:%i:%s');
    }
}