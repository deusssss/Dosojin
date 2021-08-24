<?php

class ETappa
{
    /**
     * @var int $ID_tappa progressivo della tappa nel percorso
     */
    public $ID_tappa;
    /**
     * @var int $ID_percorso identificativo del percorso relativo alla tappa
     */
    public $ID_percorso;
    /**
     * @var int $nome nome dlla tappa
     */
    public $nome;
    /**
     * @var int $indirizzo indirizzo della tappa o coordinata gps
     */
    public $indirizzo;
    /**
     * @var int $permanenza_consigliata permanenza consigliata nella tappa, espressa in minuti
     */
    public $permanenza_consigliata;
    /**
     * @var string $informazioni informazioni aggiuntive sulla tappa
     */
    public $informazioni;
    /**
     * @var string $risorse risorse utili come link a siti web ed indirizzi
     */
    public $risorse;

}