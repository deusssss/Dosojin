<?php

class EUtenteEsterno
{
    /**
     * @var int $id l'identificativo univoco dell'utente
     */
    public $id;
    /**
     * @var string $username l'username associato al profilo
     */
    public $username;
    /**
     * @var string $password hashing della password per l'accesso al profilo
     */
    public $password;
    /**
     * @var string $email email associata all'account
     */
    public $email;
    /**
     * @var string $data_iscrizione la data di iscrizione dell'utente
     */
    public $data_iscrizione;
    /**
     * @var int $account_attivo se l'account è stato attivato o meno
     */
    public $account_attivo;
    /**
     * @var string $nome nome dell'utente o del rappresentatnte dell'azienda
     */
    public $nome;
    /**
     * @var string $cognome cognome dell'utente o del rappresentatnte dell'azienda
     */
    public $cognome;
    /**
     * @var string $informazioni informazioni aggiuntive sull'account
     */
    public $informazioni;
    /**
     * @var string $tipo tipo di account (azienda o utente)
     */
    public $tipo;
    /**
     * @var string $profile_picture identificativo per la profile picture dell'utente
     */
    public $profile_picture;
}