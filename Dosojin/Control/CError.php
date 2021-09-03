<?php

/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * Controllore responsabile della schermata di errore
 */
class CError
{
    /**
     * 1 - assegna il messaggio di errore alla pagina
     * 2 - visualizza la schermata di errore tramite la view
     * @param $errore
     */
    public function impostaPaginaErrore($errore)
    {
        $errore = match ($errore) {
            'classe' => 'Non abbiamo nessuna scimmia che possa soddisfare la tua richiesta, se hai inserito un URL manualmente controlla di non aver commesso errori di digitazione',
            'metodo' => 'La scimmia che hai richiesto non è in grado di soddisfare la tua richiesta, se hai inserito un URL manualmente controlla di non aver commesso errori di digitazione',
            'cookie' => 'Le nostre scimmie potrebbero eseguire i tuoi ordini, ma per farlo vogliono dei biscotti, per favore abilita i cookies nel tuo browser, fallo per quelle scimmiette carine',
            'except' => 'Una delle nostre scimmie non è riuscita a gestire la tua richiesta, probabilmente è colpa sua, non tua, comunque controlla la URL che hai inserito, per sicurezza'
        };
        USingleton::getInstance('VErrore')->visualizzaPaginaErrore($errore);
    }
}