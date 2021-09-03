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
        if (USingleton::getInstance('FUtenteInterno')->exists(array('username' => $utente->username)) || USingleton::getInstance('FUtenteEsterno')->exists(array('username' => $utente->username)))
            return 'Nome utente già utilizzato';
        else if (USingleton::getInstance('FUtenteInterno')->exists(array('email' => $utente->email)) || USingleton::getInstance('FUtenteEsterno')->exists(array('email' => $utente->email)))
            return 'Email già utilizzata';
        else {
            if (get_class($utente) == 'EUtenteEsterno')
                $userType = 'FUtenteEsterno';
            else
                $userType = 'FUtenteInterno';
            USingleton::getInstance($userType)->store($utente);
            $utente = USingleton::getInstance($userType)->search(array('username' => $utente->username))[0];
            return $utente;
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
            return array_merge(USingleton::getInstance('FUtenteInterno')->search(array('account_attivo' => 0)), USingleton::getInstance('FUtenteEsterno')->search(array('account_attivo' => 0, 'tipo' => 'azienda'), array('data_iscrizione')));
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
    public function approvaUtente($id, $tipo = 'utente')
    {
        if ($tipo == 'moderatore' && USingleton::getInstance('FUtenteInterno')->exists(array('id' => $id))) {
            $userType = 'FUtenteInterno';
            $user = $this->getUtente($id, 'UtenteInterno');
        } else if ((($tipo == 'utente') || ($tipo == 'azienda')) && USingleton::getInstance('FUtenteEsterno')->exists(array('id' => $id))) {
            $userType = 'FUtenteEsterno';
            $user = $this->getUtente($id, 'UtenteEsterno');
        } else
            return false;
        $user->account_attivo = 1;
        USingleton::getInstance($userType)->update($user, array('id' => $id));
        return true;
    }

    /**
     * 1 - controlla se l'utente esiste come esterno o interno
     * 2 - se esiste ne restituisce l'oggetto altrimenti restituisce false
     *
     * @param int $id identificativo dell'utente
     * @return EUtenteEsterno|EUtenteInterno|false
     */
    public function getUtente($id, $tipo)
    {
        if (USingleton::getInstance('F' . $tipo)->exists(array('id' => $id)))
            return (USingleton::getInstance('F' . $tipo)->search(array('id' => $id)))[0];
        else return false;

    }

    public function approvaPercorso($id)
    {
        if (USingleton::getInstance('FPercorso')->exists(array('id' => $id))) {
            $percorso = $this->getPercorso($id);
            $percorso->approvato = 1;
            $percorso->visibile = 1;
            USingleton::getInstance('FPercorso')->update($percorso, array('id' => $id));
            return true;
        } else
            return false;
    }

    public function getPercorso($id)
    {
        $percorso = USingleton::getInstance('FPercorso')->search(array('id' => $id));
        if (count($percorso) == 0)
            return false;
        else {
            $percorso = $percorso[0];
            $percorso->tappe = USingleton::getInstance('FTappa')->search(array('ID_percorso' => $percorso->id));
            $percorso->trasporti = USingleton::getInstance('FTrasporto')->search(array('ID_percorso' => $percorso->id));
            $percorso->commenti = USingleton::getInstance('FCommento')->search(array('percorso' => $percorso->id));
            return $percorso;
        }
    }

    public function getAllPercorsi($filtri, $ordinamento)
    {
        $percorsi = USingleton::getInstance('FPercorso')->search(array_merge(array('visibile' => 1), $filtri), $ordinamento);
        foreach ($percorsi as $p) {
            $p->tappe = USingleton::getInstance('FTappa')->search(array('ID_percorso' => $p->id));
            $p->trasporti = USingleton::getInstance('FTrasporto')->search(array('ID_percorso' => $p->id));
            $p->commenti = USingleton::getInstance('FCommento')->search(array('percorso' => $p->id));
        }
        return $percorsi;
    }


    public function getPercorsiSalvati($idUtente, $filtri = array())
    {
        $PID = USingleton::getInstance('FPercorsiSalvati')->search(array('ID_utente' => $idUtente), $filtri, false);
        if (count($PID) == 0)
            return array();
        else {
            $percorsi = array();
            foreach ($PID as $p) {
                $percorsi[] = $this->getPercorso($p['ID_percorso']);
            }
            return $percorsi;
        }
    }

    public function nuovoPercorso($percorso)
    {
        USingleton::getInstance('FPercorso')->store($percorso);
        $PercorsoDB = USingleton::getInstance('FPercorso')->search(array('nome' => $percorso->nome, 'creatore' => $percorso->creatore))[0];
        foreach ($percorso->tappe as $t) {
            $t->ID_percorso = $PercorsoDB->id;
            USingleton::getInstance('FTappa')->store($t);
        }
        foreach ($percorso->trasporti as $t) {
            $t->ID_percorso = $PercorsoDB->id;

            USingleton::getInstance('FTrasporto')->store($t);
        }
        return $PercorsoDB->id;
    }


    public function EsisteNomePercorso($idUtente, $nome)
    {
        if (USingleton::getInstance('FPercorso')->exists(array('creatore' => $idUtente, 'nome' => $nome)))
            return true;
        else
            return false;
    }


    public function getPercorsiDiUtente($id)
    {
        $percorsi = USingleton::getInstance('FPercorso')->search(array('creatore' => $id), array('nome'));
        foreach ($percorsi as $p) {
            $p->tappe = USingleton::getInstance('FTappa')->search(array('ID_percorso' => $p->id));
            $p->trasporti = USingleton::getInstance('FTrasporto')->search(array('ID_percorso' => $p->id));
            $p->commenti = USingleton::getInstance('FCommento')->search(array('percorso' => $p->id));
        }
        return $percorsi;
    }

    public function pubblicaCommento($commento)
    {
        USingleton::getInstance('FCommento')->store($commento);
    }

    public function aggiungiPercorsoASalvati($userID, $id)
    {
        if (!USingleton::getInstance('FPercorsiSalvati')->exists(array('ID_utente' => $userID, 'ID_percorso' => $id)))
            USingleton::getInstance('FPercorsiSalvati')->store(array('ID_utente' => $userID, 'ID_percorso' => $id));
    }

    public function seguiPercorso($userID, $id)
    {
        if (!USingleton::getInstance('FPercorsoSeguito')->exists(array('ID_utente' => $userID, 'ID_percorso' => $id)))
            USingleton::getInstance('FPercorsoSeguito')->store(array('ID_utente' => $userID, 'ID_percorso' => $id, 'ID_tappa_corrente' => 0));
        else
            USingleton::getInstance('FPercorsoSeguito')->update(array('ID_utente' => $userID, 'ID_percorso' => $id, 'ID_tappa_corrente' => 0), array('ID_utente' => $userID));

    }

    public function nascondiPercorso($id)
    {

        $percorso = $this->getPercorso($id);
        $percorso->visibile = 0;
        USingleton::getInstance('FPercorso')->update($percorso, array('id' => $percorso->id));
    }

    public function mostraPercorso($id)
    {
        $percorso = $this->getPercorso($id);
        $percorso->visibile = 1;
        USingleton::getInstance('FPercorso')->update($percorso, array('id' => $percorso->id));

    }

    public function getPercorsoSeguito($idUtente)
    {
        $PID = USingleton::getInstance('FPercorsoSeguito')->search(array('ID_utente' => $idUtente), array(), false)[0];
        if (count($PID) == 0)
            return false;
        else {
            $percorso = array('percorso' => $this->getPercorso($PID['ID_percorso']), 'tappa' => $PID['ID_tappa_corrente']);
            return $percorso;
        }
    }

    public function prossimaTappaSeguito($userID)
    {
        $percorso = $this->getPercorsoSeguito($userID);
        $percorso['tappa'] += 1;
        USingleton::getInstance('FPercorsoSeguito')->update(array('ID_utente' => $userID, 'ID_percorso' => $percorso['percorso']->id, 'ID_tappa_corrente' => $percorso['tappa']), array('ID_utente' => $userID));

    }


    public function eliminaPercorso($id)
    {
        if (USingleton::getInstance('FPercorso')->exists(array('id' => $id))) {
            $percorso = $this->getPercorso($id);
            USingleton::getInstance('FPercorso')->delete(array('id' => $percorso->id));
            USingleton::getInstance('FTappa')->delete(array('ID_percorso' => $percorso->id));
            USingleton::getInstance('FTrasporto')->delete(array('ID_percorso' => $percorso->id));
            USingleton::getInstance('FCommento')->delete(array('percorso' => $percorso->id));
        }
    }

    public function eliminaUtente($id, $tipo = 'utente')
    {
        if ($tipo == 'moderatore' && USingleton::getInstance('FUtenteInterno')->exists(array('id' => $id))) {
            $userType = 'FUtenteInterno';
        } else if ((($tipo == 'utente') || ($tipo == 'azienda')) && USingleton::getInstance('FUtenteEsterno')->exists(array('id' => $id))) {
            $userType = 'FUtenteEsterno';
        } else
            return;
        USingleton::getInstance($userType)->delete(array('id' => $id));
        $percorsi = USingleton::getInstance('FPercorso')->search(array('creatore' => $id));
        foreach ($percorsi as $p)
            $this->eliminaPercorso($p->id);
        USingleton::getInstance('FPercorsoSeguito')->delete(array('ID_utente' => $id));
        USingleton::getInstance('FPercorsiSalvati')->delete(array('ID_utente' => $id));
    }

    public function aggiornaUtente($utente)
    {
        if (get_class($utente) == 'EUtenteEsterno')
            $userType = 'FUtenteEsterno';
        else
            $userType = 'FUtenteInterno';
        USingleton::getInstance($userType)->update($utente, array('id' => $utente->id));
    }


}