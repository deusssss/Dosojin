<?php

use PHPMailer\PHPMailer\PHPMailer;

require('PHPMailer/src/Exception.php');
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/SMTP.php');

class CInbox
{
    public function getMyInbox()
    {
        $user = (USingleton::getInstance('FPersistentManager')->getUtente(USingleton::getInstance('USession')->leggi_valore('idUtente'), 'UtenteInterno'));
        $inbox = USingleton::getInstance('FPersistentManager')->getInbox($user->id);
        USingleton::getInstance('VInbox')->mostraInbox($user, $inbox);
    }

    public function attivaPercorso($id)
    {
        USingleton::getInstance('FPersistentManager')->approvaPercorso($id);
        $p = USingleton::getInstance('FPersistentManager')->getPercorso($id);
        $u = USingleton::getInstance('FPersistentManager')->getUtente($p->creatore, 'UtenteEsterno');
        $this->getMyInbox();
        $this->inviaMail($u->username, 'percorso', 'approvato', $p->id, $u->email);
    }

    public function attivaUtente($id, $tipo)
    {
        if ($tipo == 'moderatore')
            $u = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteInterno');
        else
            $u = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteEsterno');
        USingleton::getInstance('FPersistentManager')->approvaUtente($id, $tipo);
        $this->getMyInbox();
        $this->inviaMail($u->username, 'account', 'approvato', $u->id, $u->email);
    }

    public function rifiutaPercorso($id)
    {
        $u = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteEsterno');
        $p = USingleton::getInstance('FPersistentManager')->getPercorso($id);
        USingleton::getInstance('FPersistentManager')->eliminaPercorso($id);
        $this->getMyInbox();
        $this->inviaMail($u->username, 'percorso', 'rifiutato', $p->id, $u->email);
    }

    public function rifiutaUtente($id, $tipo)
    {
        if ($tipo == 'moderatore')
            $u = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteInterno');
        else
            $u = USingleton::getInstance('FPersistentManager')->getUtente($id, 'UtenteEsterno');
        USingleton::getInstance('FPersistentManager')->eliminaUtente($id, $tipo);
        $this->getMyInbox();
        $this->inviaMail($u->username, 'account', 'rifiutato', $u->id, $u->email);
    }

    public function inviaMail($username, $cosa, $come, $id, $email)
    {

        global $config;

        $mail = new PHPMailer(true);
        $message = 'Ciao, ' . $username . ', ti informiamo che il tuo ' . $cosa . 'è stato ' . $come . '.';
        if ($come == 'approvato') {
            $message = $message . 'clicca sul link per visualizzarlo. ' . $config['url'] . '?controller=';
            if ($cosa == 'percorso')
                $message = $message . 'Utente&task=getPaginaUtente&id=' . $id;
            else
                $message = $message . 'VisualizzaPercorso&task=impostaPaginaVisualizzazione&id=' . $id;;
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
