<?php

class ECommento
{
    /**
     * @var int $id identificativo univoco del commento
     */
public $id;
    /**
     * @var int $utente utente che ha lasciato il commento
     */
public $utente;
    /**
     * @var int $rating voto al percorso
     */
public $rating;
    /**
     * @var string $testo testo del commento
     */
public $testo;
    /**
     * @var EPercorso $percorso percorso sul quale è stato lasciato il commento
     */
public $percorso;
    /**
     * @var string $data data in cui il commento è stato lasciato
     */
public $data;
}