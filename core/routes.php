<?php
    function loadController($controller){
        $name_controller = ucwords($controller).'Controller';   
        $fileController = 'controller/'.$name_controller.'.php';
        if(!is_file($fileController)){
            $fileController = 'controller/'.CONTROLLER_MAIN.'.php';
        }
        //Cargamos el controlador
        require_once $fileController;
        $controller = new $name_controller();

        return $controller;
    }
    function loadAction($controller, $action, $conexion){
        if(isset($action) && method_exists($controller, $action)){
            $controller->$action($conexion);
        }else{
            $controller->ACTION_MAIN();
        }
    }