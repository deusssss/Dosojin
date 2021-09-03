<?php

/**
 * @access public
 * @package View
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 */
class VInbox extends View
{
    /**imposta la pagina di inbox dell'utente
     * @param EUtenteInterno $user
     * @param array $inbox percorsi o utenti da approvare
     * @throws SmartyException
     */
    public function mostraInbox($user, $inbox)
    {
        $this->impostaLayout();
        $in = array();
        if (count($inbox) > 0) {
            if ($user->ruolo == 'moderatore') {
                for ($i = 0; $i < count($inbox); $i++) {
                    $in[] = array(
                        'nomePercorso' => $inbox[$i]->nome,
                        'idCreatore' => $inbox[$i]->creatore,
                        'nomeCreatore' => USingleton::getInstance('FPersistentManager')->getUtente($inbox[$i]->creatore, 'UtenteEsterno')->username,
                        'idPercorso' => $inbox[$i]->id
                    );
                }
            }
            if ($user->ruolo == 'amministratore') {
                for ($i = 0; $i < count($inbox); $i++) {
                    $in[] = array(
                        'username' => $inbox[$i]->username,
                        'idUtente' => $inbox[$i]->id,
                        'email' => $inbox[$i]->email,
                        'tipo ' => ''
                    );
                    if (get_class($inbox[$i]) == 'EUtenteInterno')
                        $in[$i]['tipo'] = 'moderatore';
                    else if (get_class($inbox[$i]) == 'EUtenteEsterno')
                        $in[$i]['tipo'] = 'azienda';
                }
            }
        } else
            $in = false;
        $this->assign('ruolo', $user->ruolo);
        $this->assign('inbox', $in);
        $this->display('inbox.tpl');
    }

}


