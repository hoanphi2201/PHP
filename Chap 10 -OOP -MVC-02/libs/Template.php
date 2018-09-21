<?php
    class Template{
        //FileConfig (admin/main/template.ini)
        private $_fileConfig;
        //FileTemplate (admin/main/index.php)
        private $_fileTemplate;
        //FileTemplate (admin/main/)
        private $_folderTemplate;
        //Controller obj
        private $_controller;

        
        public function __construct($controller){
            $this->_controller = $controller;
        }
        //FILE TEMPLATE
        public function setFileTemplate($value = 'index.php'){
            $this->_fileTemplate = $value;
        }
        public function getFileTemplate(){
            return $this->_fileTemplate;
        }
        //FILE CONFIG( template.ini)
        public function setFileConfig($value = 'template.ini'){
            $this->_fileConfig = $value;
        }
        public function getFileConfig(){
            return $this->_fileConfig;
        }
        //FOLDER TEMPLATE (default/main)
        public function setFolderTemplate($value = 'default/main'){
            $this->_folderTemplate = $value;
        }
        public function getFolderTemplate(){
            return $this->_folderTemplate;
        }

        
        
        // LOAD 
        public function load(){
            $fileConfig = $this->getFileConfig();
            $folderTemplate = $this->getFolderTemplate();
            $fileTemplate = $this->getFileTemplate();
            $pathFileConfig = TEMPLATE_PATH . $folderTemplate .$fileConfig;
            if(file_exists($pathFileConfig)){
                $arrayConfig = parse_ini_file($pathFileConfig);
                $view = $this->_controller->getView();
                $view->_title     = $view->createTitle($arrayConfig['title']);
                $view->_metaHTTP  = $view->createMeta($arrayConfig['metaHTTP'], 'http-equiv');
                $view->_metaName  = $view->createMeta($arrayConfig['metaName'], 'name');
                $view->_cssFiles  = $view->createLink($this->_folderTemplate . $arrayConfig['dirCss'], $arrayConfig['fileCss'],'css');
                $view->_jsFiles  = $view->createLink($this->_folderTemplate .$arrayConfig['dirJs'], $arrayConfig['fileJs'], 'js');
                $view->_dirImg  = $arrayConfig['dirImg'];
                $view->_templatePath = TEMPLATE_PATH . $folderTemplate .$fileTemplate;
            }
 
         }

    }