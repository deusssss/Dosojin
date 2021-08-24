<?php

require("phpmailer/class.phpmailer.php");

/**
 * @access public
 * @package Utility
 */
class UEmail
{
    private $_mail;
    private $_url;

    public function __construct()
    {
        global $config;
        $this->_mail = new PHPMailer();
        $this->_mail->IsSMTP();              // set mailer to use SMTP
        $this->_mail->Host = $config['smtp']['host'];  // specify main and backup server
        $this->_mail->Port = $config['smtp']['port'];  // specify main and backup server
        $this->_mail->SMTPAuth = $config['smtp']['smtpauth']; // turn on SMTP authentication
        $this->_mail->Username = $config['smtp']['username']; // SMTP username
        $this->_mail->Password = $config['smtp']['password']; // SMTP password
        $this->_mail->Charset = 'utf-8';
        $this->_url =$config['url'];
    }

    public function invia_email($email_destinatario, $nome_destinatario, $userCode)
    {
        $this->_mail->AddAddress($email_destinatario, $nome_destinatario);
        $this->_mail->SetFrom('dosojin@lamjex.com', 'Dosojin');
        $this->_mail->WordWrap = 50;
        $this->_mail->Subject = 'Dosojin-attivazione account';
        $this->_mail->Body = 'clicca il seguente link per essere reindirizzato alla pagina principale del sito ed attivare il tuo account:\n '.$this->_url.'?controller=registrazione&task=attivazione&id=';
        $this->_mail->Send();

    }
}
