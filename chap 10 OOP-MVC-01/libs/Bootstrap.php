<?php
    class Bootstrap{
        private $_url;
        private $_controller;

        public function Init(){
            $this->setURL();
            if(!isset($this->_url['controller'])){
                $this->loadDefaultController();
                exit();
            }
            $this->loadExistController();
            $this->callControllerMethod();
            // $controllerName = ucfirst($controllerURL);
            // $file = CONTROLLER_PATH . $controllerURL .'.php';
            // if(file_exists($file)){
            //     require_once ($file);
            //     $controller = new $controllerName();
            //     if(method_exists($controller, $actionURL) == true){
            //         //Tự động load vào model
            //         $controller->loadModel($controllerURL);
            //         $controller->$actionURL();
            //     }else{
            //         $this->error();
            //     }
            // }else{
            //     $this->error();
            // }
        }

        private function setURL(){
             // lấy controller từ url
             $this->_url = isset($_GET) ? $_GET : null;
        }
        //load Default controller
        private function loadDefaultController(){
            require_once (CONTROLLER_PATH . 'index.php');
            $this->_controller = new Index();
            $this->_controller->index();

       }
        //load  controller
        private function loadExistController(){
            $file = CONTROLLER_PATH . $this->_url['controller'] .'.php';
            if(file_exists($file)){
                require_once ($file);
                $this->_controller = new $this->_url['controller']();

                $this->_controller->loadModel($this->_url['controller']);
            }else{
                $this->error();
            }

       }

        //call method
        private function callControllerMethod(){
               if(method_exists($this->_controller, $this->_url['action']) == true){
                    //Tự động load vào model
                   $this->_controller->{$this->_url['action']}();
                }else{
                    $this->error();
                }

       }
        public function error(){
            //gặp lỗi sẽ chuyển đến class error
            require_once (CONTROLLER_PATH . 'error.php');
            $error = new Error_MVC();
            $error->index();
        }
    }