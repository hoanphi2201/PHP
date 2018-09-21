<?php
    class IndexController extends Controller{
        public function __construct($arrParams){
            parent::__construct($arrParams);
            $this->_templateObj->setFolderTemplate('default/main/');
            $this->_templateObj->setFileTemplate('index.php');
            $this->_templateObj->setFileConfig('template.ini');
            $this->_templateObj->load();
        }
        public function indexAction(){
            // // Có thể load được model từ 1 module khác
            // $this->setModel('admin', 'index');
            // $this->_model->listItems();
            // //Hiển thị giao diện
            // $this->_view->data = array('PHP', 'Joomla');
            // $this->_view->render('user/index');
            echo __METHOD__;
        }
        public function loginAction(){
            $this->_view->setTitle('Login');
            $this->_view->render('user/login');
        }
    }