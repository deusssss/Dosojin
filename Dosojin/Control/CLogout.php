<?php
class CLogout{
    public function smista(){
        $this->logout();
    }
    public function logout(){
        USingleton::getInstance('USession')->destroy();
        USingleton::getInstance('CHome')->impostaPaginaHome();

    }
}