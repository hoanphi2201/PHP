<?php
    class View{
        public $_moduleName;
        public $_templatePath;
        public $_title;
        public $_metaHTTP;
        public $_metaName;
        public $_cssFiles;
        public $_jsFiles;
        public $_dirImg;
        public $_fileView;



        public function __construct($moduleName){
            $this->_moduleName = $moduleName;
        }
        public function setTitle($title){
            $this->_title = '<title>'.$title.'</title>';
        }
        public function appendFileCss($arrayCSS){
            if(!empty($arrayCSS)){
                foreach ($arrayCSS as $key => $css) {
                    $file = APPLICATION_URL  . $this->_moduleName .  DS  .'views' .DS. $css;
                    $this->_cssFiles .= '<link rel="stylesheet" href="'.$file.'">';
                }
            }
        }
        
        public function appendFileJs($arrayJS){
            if(!empty($arrayJS)){
                foreach ($arrayJS as $key => $js) {
                    $file = APPLICATION_URL  . $this->_moduleName .  DS  .'views' .DS. $js;
                    $this->_jsFiles .= '<script type="text/javascript" src="'.$file .'"></script>';
                }
            }
        }
        public function render($fileInclude, $loadFull = true){
            /**
             * $module = default
             * $fileInclude = user/index
             */
            $path = APPLICATION_PATH . $this->_moduleName.DS . 'views' . DS . $fileInclude . '.php';
            if(file_exists($path)){
                if($loadFull == true){
                    $this->_fileView = $fileInclude;
                    require_once $this->_templatePath;
                }else{
                    require_once $path;
                }
            }else{
                echo "<h3>" . __METHOD__ . '</h3>:Error';
            }
            
        }
        //CREATE title
        public function createTitle($value){
            return '<title>'.$value.'</title>';
        }
        //CREATE META NAME + HTTP
        public function createMeta($arrMetaHTTP, $typeMeta = 'name'){
            $xhtml = "";
            if(!empty($arrMetaHTTP)){
                foreach ($arrMetaHTTP as $key => $meta) {
                    $temp = explode('|', $meta);
                    $xhtml .= '<meta '.$typeMeta.'="'.$temp[0].'" content="'.$temp[1].'">';
                }
            }
            return $xhtml;
        }
       //CREATE CSS + JS
        public function createLink($path, $files, $type = 'css'){
            $xhtml = "";
            if(!empty($files)){
                $path = TEMPLATE_URL . $path;
                foreach ($files as $key => $file) {
                    if($type == 'css'){
                        $xhtml .= '<link rel="stylesheet" href="'.$path .DS.$file.'">';
                    }else if ($type = 'js'){
                        $xhtml .= '<script type="text/javascript" src="'.$path .DS. $file .'"></script>';
                    }
                }
            }
            return $xhtml;
        }
    }