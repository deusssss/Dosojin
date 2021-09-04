<?php
/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Controllore responsabile di visualizzare e gestire la inbox di un moderatore o amministratore
 */

use PHPMailer\PHPMailer\PHPMailer;

require('PHPMailer/src/Exception.php');
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/SMTP.php');

class CInbox
{
    /**
     * 1 - recupera l'utente dalla sessione
     * 2 - recupera l'inbox dell'utente dal FC
     * 3 - mostra la pagina di visualizzazione dell'inbox dalla view
     * @throws Exception
     */
    public function getMyInbox()
    {
        if (USingleton::getInstance('USession')->leggi_valore('tipoUtente') == 'UtenteInterno') {
            $user = (USingleton::getInstance('FPersistentManager')->getUtente(USingleton::getInstance('USession')->leggi_valore('idUtente'), 'UtenteInterno'));
            $inbox = USingleton::getInstance('FPersistentManager')->getInbox($user->id);
            USingleton::getInstance('VInbox')->mostraInbox($user, $inbox);
        } else
            throw new Exception();
    }

    /**
     * attiva un percorso ed invia una mail di conferma al creatore
     * @param int $id id del percorso
     * @throws \PHPMailer\PHPMailer\Exception
     * @throws Exception
     */
    public function attivaPercorso(int $id)
    {
        if (USingleton::getInstance('USession')->leggi_valore('tipoUtente') == 'UtenteInterno') {
            USingleton::getInstance('FPersistentManager')->approvaPercorso($id);
            $p = USingleton::getInstance('FPersistentManager')->getPercorso($id);
            $u = USingleton::getInstance('FPersistentManager')->getUtente($p->creatore, 'UtenteEsterno');
            $this->getMyInbox();
            $this->inviaMail($u->username, 'percorso', 'approvato', $p->id, $u->email);
        } else
            throw new Exception();
    }

    /**
     * attiva un account ed invia una mail di conferma all'utente
     * @param int $id id dell'account
     * @param string $tipo
     * @throws \PHPMailer\PHPMailer\Exception
     * @throws Exception
     */
    public function attivaUtente(int $id, string $tipo)
    {
        if (USingleton::getInstance('USession')->leggi_valore('tipoUtente') == 'UtenteInterno') {
            if ($tipo == 'moderatore')
                $u = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteInterno');
            else
                $u = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteEsterno');
            USingleton::getInstance('FPersistentManager')->approvaUtente($id, $tipo);
            $this->getMyInbox();
            $this->inviaMail($u->username, 'account', 'approvato', $u->id, $u->email);
        } else
            throw new Exception();
    }

    /**
     * rifiuta un percorso ed invia una mail di conferma al creatore
     * @param int $id id del percorso
     * @throws Exception
     */
    public function rifiutaPercorso(int $id)
    {
        if (USingleton::getInstance('USession')->leggi_valore('tipoUtente') == 'UtenteInterno') {
            $p = USingleton::getInstance('FPersistentManager')->getPercorso($id);
            $u = USingleton::getInstance('FPersistentManager')->getUtente($p->creatore, 'UtenteEsterno');
            USingleton::getInstance('FPersistentManager')->eliminaPercorso($id);
            $this->getMyInbox();
            $this->inviaMail($u->username, 'percorso', 'rifiutato', $p->id, $u->email);
        } else
            throw new Exception();
    }

    /**
     * rifiuta un account ed invia una mail di conferma all'utente
     * @param int $id id dell'account
     * @param string $tipo
     * @throws Exception
     */
    public function rifiutaUtente(int $id, string $tipo)
    {
        if (USingleton::getInstance('USession')->leggi_valore('tipoUtente') == 'UtenteInterno') {
            if ($tipo == 'moderatore')
                $u = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteInterno');
            else
                $u = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteEsterno');
            USingleton::getInstance('FPersistentManager')->eliminaUtente($id, $tipo);
            $this->getMyInbox();
            $this->inviaMail($u->username, 'account', 'rifiutato', $u->id, $u->email);
        } else
            throw new Exception();
    }

    /**
     * invia una mail ad un utente per informarlo che il suo percorso o account è stato approvato o rifiutato
     *
     * @param string $username nome utente
     * @param string $cosa percorso o account
     * @param string $come approvato o rifiutato
     * @param int $id id del percorso o utente
     * @param string $email email dell'utente
     *
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function inviaMail(string $username, string $cosa, string $come, int $id, string $email)
    {

        global $config;

        $mail = new PHPMailer(true);
        $message = 'Ciao, ' . $username . ', ti informiamo che il tuo ' . $cosa . 'è stato ' . $come . '.';
        if ($come == 'approvato') {
            $message = $message . 'clicca sul link per visualizzarlo. ' . $config['url'] ;
            if ($cosa == 'account')
                $message = $message . 'Utente/getPaginaUtente/' . $id;
            else
                $message = $message . 'VisualizzaPercorso/impostaPaginaVisualizzazione/' . $id;
        } else
            $message = $message . ' Riprova assicurandoti di rispettare le norme del regolamento';

        $mail->IsSMTP();
        $mail->Host = $config['smtp']['host'];
        $mail->SMTPAuth = $config['smtp']['smtpauth'];
        $mail->Username = $config['smtp']['username'];
        $mail->Password = $config['smtp']['password'];
        $mail->Port = $config['smtp']['port'];
        $mail->setFrom($config['smtp']['sender']);
        $mail->addAddress($email);
        $mail->Subject = $cosa . ' ' . $come;
        $mail->Body = $message;

        $mail->send();
    }

}
