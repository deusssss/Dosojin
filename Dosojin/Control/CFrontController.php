<?php


/**
 * @access public
 * @package Control
 *
 * @author Lorenzo D'eusebio
 * @author Beatrice Toscano
 *
 * La classe CFrontController rappresenta l'omonimo strumento, un pannello di interazione attrverso il quale main.php può efficacemente gestire le richieste smistandole per controller e task
 */
class CFrontController
{
    /**
     * Smista le richieste ai vari controller, i quali gestiscono la task in base alle varie situazioni
     * nel caso di una richiesta senza controllore, o con controllore/task inesistente reindirizza alla home page
     *
     */
    public function smista()
    {
        if (!isset($_COOKIE['testcookie']))
            setcookie('testcookie', 'testcookie');
        if (isset($_COOKIE['testcookie'])) {
            $request = array_slice(explode('/', $_SERVER['REQUEST_URI']), 2);
            if ($request[0] == '')
                USingleton::getInstance('CHome')->impostaPaginaHome();
            else if (@class_exists('C' . $request[0])) {
                $class = USingleton::getInstance('C' . $request[0]);
                if (method_exists($class, $request[1])) {
                    $method = $request[1];
                    $params = array_slice($request, 2);
                    try {
                        $class->$method(...$params);
                    }
                    catch (Error){
                        USingleton::getInstance('CError')->impostaPaginaErrore('except');
                    }
                } else {
                    USingleton::getInstance('CError')->impostaPaginaErrore('metodo');
                }
            } else {
                USingleton::getInstance('CError')->impostaPaginaErrore('classe');
            }
        } else {
            USingleton::getInstance('CError')->impostaPaginaErrore('cookie');
        }
    }


}



