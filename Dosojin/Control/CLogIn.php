<?php

/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Controllore del login
 */
class CLogin
{
    /**
     * attiva l'account di un utente esterno
     *
     * @param $id id utente
     */
    public function attiva($id)
    {
        if (USingleton::getInstance('FPersistentManager')->approvaUtente($id))
            $this->getLoginForm();
        else
            $this->getLoginForm('Utente non trovato');
    }


    /**
     * chiama la view che restituisce il form di login all'utente
     *
     * @param string $text informazioni su eventuali errori
     */
    public function getLoginForm($text = '')
    {
        USingleton::getInstance('VLogin')->mostraFormLogin($text);
    }

    /**
     * 1 - controlla che le credenziali inserite dall'utente siano valide, altrimenti restituisce false
     * 2 - inserisce l'id dell'utente nella variabile di sessione, rendendola effettivamente attiva
     * 3 - reindirizza alla home page
     */
    public function autentica()
    {
        $user = USingleton::getInstance('FPersistentManager')->logUtente($_POST['username'], hash('md5', $_POST['password']));
        if ($user != false) {
            if ($user->account_attivo == 0) {
                $this->getLoginForm('Attiva il tuo account per effettuare il login');
                return;
            } else {
                USingleton::getInstance('USession')->imposta_valore('idUtente', $user->id);
                USingleton::getInstance('USession')->imposta_valore('tipoUtente', ltrim(get_class($user), 'E'));
                USingleton::getInstance('CHome')->impostaPaginaHome();
            }
        } else {
            $this->getLoginForm('utente non trovato');
        }
    }


}