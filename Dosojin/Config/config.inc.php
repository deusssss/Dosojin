<?php

global $config;
//smarty
$config['smarty']['template_dir'] = 'Smarty/templates';
$config['smarty']['compile_dir'] = 'Smarty/templates_c';
$config['smarty']['config_dir'] = 'Smarty/configs';
$config['smarty']['cache_dir'] = 'Smarty/main/cache';
//mysql
$config['mysql']['user'] = 'root';
$config['mysql']['password'] = '';
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'dosojin';
//phpmailer
$config['smtp']['host'] = 'smtp.mailtrap.io';
$config['smtp']['sender'] = 'de7f00c8d0-ccb0a7@inbox.mailtrap.io';
$config['smtp']['port'] = '2525';
$config['smtp']['smtpauth'] = true;
$config['smtp']['username'] = '449c17f586ce51';
$config['smtp']['password'] = '8dad622de4306f';

$config['url']='https://localhost/Dosojin/';