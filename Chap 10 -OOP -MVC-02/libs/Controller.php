<?php
    class Controller{
        //View object
        protected $_view;
        //Model object
        protected $_model;
        //Template object
        protected $_templateObj;
        //params (nhận từ GET và POST)
        protected $_arrParam;
        public function __construct($arrParams){
            $this->setModel($arrParams['module'], $arrParams['controller']);
            //Set view ở class Controller
            $this->setView($arrParams['module']);
            $this->setTemplate($this);
            $this->setParams($arrParams);
        }
        //Hàm này sẽ load phần model 1 cách tự động
        public function setModel($moduleName, $modelName){
            $modelName = ucfirst($modelName) . 'Model';
            $path = APPLICATION_PATH . $moduleName . DS .'models' . DS . $modelName .'.php';
            if(file_exists($path)){
                require_once $path;
                $this->_model = new $modelName();
            }
        }
        public function getModel(){
            return $this->_model;
        }
        /*Vấn đề gặp phải là khi ko có module ở $_GET xảy ra lỗi nên ta cần phải setView 
        *ở class Bootstrap vì đã có module mặc định ở đó
        */
        public function setView($moduleName){
            $this->_view = new View($moduleName);
        }
        public function getView(){
            return $this->_view;
        }
        //TEMPLATE
        public function setTemplate(){
            $this->_templateObj = new Template($this);
            
        }
        public function getTemplate(){
            return $this->_templateObj;
        
        }
        //PARAMS
        public function setParams($arrParam){
            
            $this->_arrParam = $arrParam;
        }
        public function getParams($arrParam){
            
            return $this->_arrParam;
        }
        
    }