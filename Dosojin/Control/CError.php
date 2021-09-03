<?php

/**
 * La classe CFrontController rappresenta l'omonimo strumento, un pannello di interazione attrverso il quale main.php può efficacemente gestire le richieste smistandole per controller e task
 *
 * @access public
 * @package Control
 */
class CError
{
    public function impostaPaginaErrore($errore){
        switch ($errore){
            case 'classe':
                $errore='Non abbiamo nessuna scimmia che possa soddisfare la tua richiesta, se hai inserito un URL manualmente controlla di non aver commesso errori di digitazione';
                break;
            case 'metodo':
                $errore='La scimmia che hai richiesto non è in grado di soddisfare la tua richiesta, se hai inserito un URL manualmente controlla di non aver commesso errori di digitazione';
                break;
            case 'cookie':
                $errore='Le nostre scimmie potrebbero eseguire i tuoi ordini, ma per farlo vogliono dei biscotti, per favore abilita i cookies nel tuo browser, fallo per quelle scimmiette carine';
                break;
        }
        USingleton::getInstance('VErrore')->visualizzaPaginaErrore($errore);
    }
}