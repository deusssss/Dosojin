<?php
require('Smarty/libs/Smarty.class.php');
/**
 * La classe view estende il template Engine Smarty e funge da punto di partenza per tutte le altre classi nel package view
 *
 * @access public
 * @package View
 */
class View extends Smarty
{
    public function __construct()
    {
        parent::__construct();
        global $config;
        $this->template_dir = $config['smarty']['template_dir'];
        $this->compile_dir = $config['smarty']['compile_dir'];
        $this->config_dir = $config['smarty']['config_dir'];
        $this->cache_dir = $config['smarty']['cache_dir'];
        $this->caching = false;
    }
}