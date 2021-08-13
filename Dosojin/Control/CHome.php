<?php

/**
 * @access public
 * @package Control
 */
class CHome
{
    /**
     * Imposta la pagina, controlla l'autenticazione
     */
    public function impostaPagina()
    {
    }


    /**
     * Smista le richieste ai vari controller
     *
     * @return void
     */
    public function smista()
    {
        $view = USingleton::getInstance('VHome');
        switch ($view->getController()) {
            case 'registrazione':
                $azione = USingleton::getInstance('CRegistrazione');
                break;
            case 'logIn':
                $azione = USingleton::getInstance('CLogIn');
                break;
            case 'userPage':
                $azione = USingleton::getInstance('CPaginaUtente');
                break;
            case 'visualizzaPercorsi':
                $azione = USingleton::getInstance('CSfogliaPercorsi');
                break;
            case 'creaPercorso':
                $azione = USingleton::getInstance('CCreaPercorso');
                break;
            case 'percorsoSeguito':
                $azione = USingleton::getInstance('CPercorsoSeguito');
                break;
            case 'inBox':
                $azione = USingleton::getInstance('CInBox');
                break;
            default:
                $this->impostaPagina();
                return;
        }

        $azione->smista();
    }
}
