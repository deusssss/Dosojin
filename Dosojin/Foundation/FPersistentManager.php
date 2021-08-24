<?php

/**
 * Il *_leggere con tono fighissimo di cicerone quando lo ha detto_ "MANAGER DELLA PERSISTENZA", si occupa di smistare le varie richieste ai metodi del package foundation, fungendo effettivamente come porta di accesso ad esso.
 *
 */
class FPersistentManager
{
    /**
     * 1 - controlla se l'utente esiste come esterno o interno
     * 2 - se esiste ne restituisce l'oggetto altrimenti restituisce false
     *
     * @param string $username
     * @param string $password
     * @return boolean|false
     */
    public function logUtente($username, $password)
    {
        if (USingleton::getInstance('FUtenteEsterno')->exists(array('username' => $username, 'password' => $password)))
            $userType = 'FUtenteEsterno';
        else if (USingleton::getInstance('FUtenteInterno')->exists(array('username' => $username, 'password' => $password)))
            $userType = 'FUtenteInterno';
        else return false;
        return USingleton::getInstance($userType)->search(array('username' => $username, 'password' => $password))[0];
    }

    /**
     * 1 - crea un utente esterno sul database mail ed username non sono già stati usati
     * 2 - restituisce l'id dell'utente o il dato duplicato sul database
     *
     * @param EUtenteEsterno|EUtenteInterno $utente
     * @return EUtenteEsterno|EUtenteInterno|string
     */
    public function nuovoUtente($utente)
    {
        if (get_class($utente) == 'EUtenteInterno')
            $userType = 'FUtenteInterno';
        else
            $userType = 'FUtenteEsterno';
        if (USingleton::getInstance($userType)->exists(array('username' => $utente->username)))
            return 'nome usato';
        else if (USingleton::getInstance($userType)->exists(array('email' => $utente->email)))
            return 'mail usata';
        else {
            USingleton::getInstance($userType)->store($utente);
            return USingleton::getInstance($userType)->search(array('username' => $utente->username))[0];
        }
    }

    /**
     * 1 - controlla se l'utente che richiede la sua inbox è un amministratore o un moderatore
     * 2 - nel primo caso restituisce gli utenti in attesa di approvazione, nel secondo i percorsi, altrimenti restituisce false
     *
     * @param int $intUserID l'ID dell'utente interno che richiede la sua inbox
     * @return array|false
     */
    public function getInbox($intUserID)
    {
        if (USingleton::getInstance('FUtenteInterno')->search(array('id' => $intUserID))[0]->ruolo == 'amministratore')
            return array(USingleton::getInstance('FUtenteInterno')->search(array('account_attivo' => 0), array('data_iscrizione')), USingleton::getInstance('FUtenteEsterno')->search(array('account_attivo' => 0, 'tipo' => 'azienda'), array('data_iscrizione')));
        else if (USingleton::getInstance('FUtenteInterno')->search(array('id' => $intUserID))[0]->ruolo == 'moderatore')
            return USingleton::getInstance('FPercorso')->search(array('approvato' => 0));
        else
            return false;
    }

    /**
     * 1 - controlla che l'utente da approvare esista e se è interno o esterno, altrimenti restituisce false
     * 2 - attiva l'account sul db
     * 3 - restituisce true se tutto è andato a buon fine
     *
     * @param EUtenteEsterno|EUtenteInterno $user oggetto utente in questione
     * @return bool
     */
    public function approvaUtente($user)
    {
        if (USingleton::getInstance('FUtenteInterno')->exists(array('id' => $user->id))) {
            $userType = 'EUtenteInterno';
        } else if (USingleton::getInstance('FUtenteEsterno')->exists(array('id' => $user->id))) {
            $userType = 'EUtenteEsterno';
        } else
            return false;
        $user->account_attivo = 1;
        USingleton::getInstance($userType)->update($user, array('id' => $user->id));
        return true;
    }

    /**
     * 1 - controlla se l'utente esiste come esterno o interno
     * 2 - se esiste ne restituisce l'oggetto altrimenti restituisce false
     *
     * @param int $id identificativo dell'utente
     * @return EUtenteEsterno|EUtenteInterno|false
     */
    public function getUtente($id)
    {
        if (USingleton::getInstance('FUtenteEsterno')->exists(array('id' => $id)))
            $userType = 'FUtenteEsterno';
        else if (USingleton::getInstance('FUtenteInterno')->exists(array('id' => $id)))
            $userType = 'FUtenteInterno';
        else return false;
        return USingleton::getInstance($userType)->search(array('id' => $id))[0];

    }


    public function getPercorso($id)
    {
    }

    public function updatePercorso($id, $newPercorso)
    {
    }

    public function savePercorso($newPercorso)
    {
    }

    public function deletePercorso($id)
    {
    }

    public function getListaPercorsi($filtri)
    {
    }

    public function aggiungiPercorsoASalvati($id, $userID)
    {
    }

    public function seguiPercorso($id, $userID)
    {
    }

    public function rimuoviPercorsoDaSalvati($id, $userID)
    {
    }

    public function SmettiDiSeguirePercorso($id, $userID)
    {
    }

    public function prossimaTappaSeguito($id, $userID)
    {
    }

    public function getPercorsiSalvati($idUtente)
    {
    }

    public function getPercorsoSeguito($idUtente)
    {
    }

    public function aggiungiCommento($commento)
    {
    }

    public function rimuoviCommento($commento)
    {
    }

    public function modificaCommento($id, $nuovoCommento)
    {
    }

    public function modificaUtente($id, $newUtente)
    {
    }

    public function eliminaUtente($id)
    {
    }

    public function approvaPercorso($id)
    {
    }


}