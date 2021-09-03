<?php

class EUtenteInterno
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
     * @var int $account_attivo se l'account è stato attivato o meno
     */
    public $account_attivo;
    /**
     * @var string $ruolo il ruolo dell'utente interno, quindi amministratore o moderatore
     */
    public $ruolo;
    /**
     * @var string $profile_picture identificativo per la profile picture dell'utente
     */
    public $profile_picture;
}