<?php
    class Bootstrap{
        /**
         * Nhận điều hướng từ biến GET
         * param chứa phần điều hướng lấy được từ biến post meage với biến get
         * $_controllerObject là đối tượng controller 
         */
        private $_params;
        private $_controllerObject;
        public function init(){
            $this->setParam();
            //Indexcontroller.php = ucfirt($controller) + controller + .php
            $controllerName     = ucfirst($this->_params['controller']) . 'Controller'; 
            $filePath           = MODULE_PATH . $this->_params['module'] . DS . 'controllers' . DS . $controllerName . '.php';
            //Kiểm tra file tồn tại không
            if(file_exists($filePath)){
                $this->loadExistingController($filePath, $controllerName);
                $this->callMethod();
            }
        }
        public function setParam(){
            $this->_params = array_merge($_GET, $_POST);
            $this->_params['module'] = isset($this->_params['module']) ? $this->_params['module'] : DEFAULT_MODULE;
            $this->_params['controller'] = isset($this->_params['controller']) ? $this->_params['controller'] : DEFAULT_CONTROLLER;   
            $this->_params['action'] = isset($this->_params['action']) ? $this->_params['action'] : DEFAULT_ACTION;   

        }
        
        // LOAD EXISTING CONTROLLER
        private function loadExistingController($filePath, $controllerName){
            require_once $filePath;
            $this->_controllerObject   = new $controllerName($this->_params);
            
        }
         // CALL METHOD
         private function callMethod(){
            $actionName         = $this->_params['action'] . 'Action'; //Tạo tên action
            //Kiểm tra xem action có trong controller hay không
            if(method_exists($this->_controllerObject, $actionName) == true){
                $this->_controllerObject->$actionName();
            }else{
                $this->_error();
            }
        }
        //ERROR CONTROLLER
        public function _error(){
            //gặp lỗi sẽ chuyển đến class error
            require_once (MODULE_PATH . 'default' . DS . 'controllers' . DS . 'ErrorController.php');
            $this->_controllerObject= new ErrorController();
            //Set view cho class Error
            $this->_controllerObject->setView('default');
            $this->_controllerObject->indexAction();
        }
    }