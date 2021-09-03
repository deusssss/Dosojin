<?php

/**
 * @access public
 * @package View
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 */
class VUtente extends View
{
    /**
     * visualizza una pagina utente
     *
     * @param EUtenteInterno|EUtenteEsterno $user
     * @param array $percorsiCreati lista dei percorsi creati dall'utente
     * @throws SmartyException
     */
    public function mostraPaginaUtente($user, $percorsiCreati){

        if (get_class($user) == 'EUtenteEsterno') {
            $userArray = array(
                'idUtenteVisualizzato' => $user->id,
                'usernameUtenteVisualizzato' => $user->username,
                'nomeUtenteVisualizzato' => $user->nome,
                'cognomeUtenteVisualizzato' => $user->cognome,
                'emailUtenteVisualizzato' => $user->email,
                'attivoUtenteVisualizzato' => $user->account_attivo,
                'tipoUtenteVisualizzato' => $user->tipo,
                'informazioniUtenteVisualizzato'=>$user->informazioni,
                'propicUtenteVisualizzato' => 'Smarty/immagini/profile/' . $user->profile_picture,
                'creati' => array()
            );

            foreach ($percorsiCreati as $p) {
                $userArray['creati'][] = array(
                    'id' => $p->id,
                    'nome' => $p->nome,
                    'approvato' => $p->approvato,
                    'visibile' => $p->visibile,
                    'luogo' => $p->luogo,
                    'rating' => $p->calcolaRating(),
                    'tappe' => count($p->tappe),
                    'trasporti' => count($p->trasporti),
                );
            }
        } else {
            $userArray = array(
                'idUtenteVisualizzato' => $user->id,
                'usernameUtenteVisualizzato' => $user->username,
                'emailUtenteVisualizzato' => $user->email,
                'attivoUtenteVisualizzato' => $user->account_attivo,
                'tipoUtenteVisualizzato' => $user->ruolo,
                'propicUtenteVisualizzato' =>'Smarty/immagini/profile/' . $user->profile_picture,
            );
        }


        foreach ($userArray as $key => $value)
            $this->assign($key, $value);
        $this->impostaLayout();
        $this->display('visualizzaschedautente.tpl');
    }
}