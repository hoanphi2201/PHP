<?php
    class Controller{
        function __construct(){
            $this->view = new View();
        }
        public function loadModel($name){
            $path = MODEL_PATH . $name.'_model.php';
            $modelName = ucfirst($name) . '_model';
            if(file_exists($path)){
                require_once $path;
                $this->database = new $modelName();
            }
        }
        public function redirect($controller = 'index', $action='index' ){
            header('location: index.php?controller='.$controller.'&action='.$action.'');
            exit();
        }
    }