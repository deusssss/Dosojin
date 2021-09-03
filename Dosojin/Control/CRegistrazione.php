<?php

use PHPMailer\PHPMailer\PHPMailer;

require('PHPMailer/src/Exception.php');
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/SMTP.php');

/**
 * @access public
 * @package Control
 */
class CRegistrazione
{

    public function getSignUpForm()
    {
        USingleton::getInstance('VRegistrazione')->mostraFormRegistrazione();
    }

    public function getSignUpFormMod()
    {
        USingleton::getInstance('VRegistrazione')->mostraFormRegistrazione('', true);
    }

    public function valutaRichiesta()
    {
        if (isset($_POST['azienda'])) $this->valutaRichiestaAzienda();
        else if (isset($_POST['mod'])) $this->valutaRichiestaMod();
        else  $this->valutaRichiestaUser();
    }

    public function valutaRichiestaMod()
    {
        if ($_POST['password'] != $_POST['confirm_password']) {
            USingleton::getInstance('VRegistrazione')->mostraFormRegistrazione('La password e la conferma non coincidono');
        } else {
            $newUser = new EUtenteInterno();
            $newUser->username = $_POST['username'];
            $newUser->password = hash('md5', $_POST['password']);
            $newUser->email = $_POST['email'];
            $newUser->data_iscrizione = date("Y-m-d");
            $newUser->account_attivo = 0;
            $newUser->profile_picture = 'ProPic_admin.png';
            $newUser->ruolo = 'moderatore';
            $stat = USingleton::getInstance('FPersistentManager')->nuovoUtente($newUser);
            if (is_string($stat)) {
                USingleton::getInstance('VRegistrazione')->mostraFormRegistrazione($stat, true);
            } else {
                USingleton::getInstance('CHome')->impostaPaginaHome();
            }
        }
    }

    public function valutaRichiestaAzienda()
    {
        if ($_POST['password'] != $_POST['confirm_password']) {
            USingleton::getInstance('VRegistrazione')->mostraFormRegistrazione('La password e la conferma non coincidono');
        } else {
            $newUser = new EUtenteEsterno();
            $newUser->username = $_POST['username'];
            $newUser->password = hash('md5', $_POST['password']);
            $newUser->email = $_POST['email'];
            $newUser->data_iscrizione = date("Y-m-d");
            $newUser->account_attivo = 0;
            $newUser->nome = $_POST['nome'];
            $newUser->cognome = $_POST['cognome'];
            $newUser->profile_picture = 'ProPic_default.png';
            $newUser->tipo = 'azienda';
            $stat = USingleton::getInstance('FPersistentManager')->nuovoUtente($newUser);
            if (is_string($stat)) {
                USingleton::getInstance('VRegistrazione')->mostraFormRegistrazione($stat);
            } else {
                USingleton::getInstance('CHome')->impostaPaginaHome();
            }
        }
    }

    public function valutaRichiestaUser()
    {
        if ($_POST['password'] != $_POST['confirm_password']) {
            USingleton::getInstance('VRegistrazione')->mostraFormRegistrazione('La password e la conferma non coincidono');
        } else {
            $newUser = new EUtenteEsterno();
            $newUser->username = $_POST['username'];
            $newUser->password = hash('md5', $_POST['password']);
            $newUser->email = $_POST['email'];
            $newUser->data_iscrizione = date("Y-m-d");
            $newUser->account_attivo = 0;
            $newUser->nome = $_POST['nome'];
            $newUser->cognome = $_POST['cognome'];
            $newUser->profile_picture = 'ProPic_default.png';
            $newUser->tipo = 'utente';


            $stat = USingleton::getInstance('FPersistentManager')->nuovoUtente($newUser);
            if (is_string($stat)) {
                USingleton::getInstance('VRegistrazione')->mostraFormRegistrazione($stat);
            } else {

                global $config;

                $mail = new PHPMailer(true);
                $message = 'Ciao, ' . $_POST['username'] . ', e benvenuto in Dosojin,
                    clicca sul link per attivare il tuo acount ' . $config['url'] . '/?controller=Login&task=attiva&id=' . $stat->id;


                $mail->IsSMTP();
                $mail->Host = $config['smtp']['host'];
                $mail->SMTPAuth = $config['smtp']['smtpauth'];
                $mail->Username = $config['smtp']['username'];
                $mail->Password = $config['smtp']['password'];
                $mail->Port = $config['smtp']['port'];
                $mail->setFrom($config['smtp']['sender']);
                $mail->addAddress($_POST['email']);
                $mail->Subject = 'Conferma il tuo account';
                $mail->Body = $message;

                $mail->send();


                USingleton::getInstance('CHome')->impostaPaginaHome();

            }
        }
    }


}