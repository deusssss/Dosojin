<?php
spl_autoload_register(function ($class_name) {
    switch ($class_name[0]) {
        case 'V':
            include('View/' . $class_name . '.php');
            break;
        case 'F':
            include('Foundation/' . $class_name . '.php');
            break;
        case 'E':
            include('Entity/' . $class_name . '.php');
            break;
        case 'C':
            include('Control/' . $class_name . '.php');
            break;
        case 'U':
            include('Utility/' . $class_name . '.php');
            break;
    }
});