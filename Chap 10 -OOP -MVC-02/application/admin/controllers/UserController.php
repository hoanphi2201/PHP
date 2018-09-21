<?php
    class UserController extends Controller{
        public function __construct($arrParams){
            parent::__construct($arrParams);
            $this->_templateObj->setFolderTemplate('admin/main/');
            $this->_templateObj->setFileTemplate('index.php');
            $this->_templateObj->setFileConfig('template.ini');
            $this->_templateObj->load();
        }
        public function loginAction(){
            $this->_view->setTitle('Login');
            $this->_view->appendFileCss(array('user/css/abc.css'));
            $this->_view->appendFileJs(array('user/js/abc.js'));
            $this->_view->render('user/login');
        }
        public function logoutAction(){
            $this->_view->setTitle('Logout');
            $this->_view->render('user/logout');
        }
    }