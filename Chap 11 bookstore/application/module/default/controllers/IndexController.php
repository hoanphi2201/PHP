<?php
    class IndexController extends Controller{
        public function __construct($arrParams){
            parent::__construct($arrParams);
            $this->_templateObj->setFolderTemplate('default/main/');
            $this->_templateObj->setFileTemplate('index.php');
            $this->_templateObj->setFileConfig('template.ini');
            $this->_templateObj->load();
        }
        public function registerAction(){
            if(isset($this->_arrParam['form']['submit'])){
                URL::checkRefreshPage($this->_arrParam['form']['token'],'default', 'user','register');
                $queryUsername  = "SELECT `id` FROM `user` WHERE `username`='" . $this->_arrParam['form']['username'] . "'";
                $queryEmail     = "SELECT `id` FROM `user` WHERE `email`='" . $this->_arrParam['form']['email'] . "'";
                
                $validate       = new Validate($this->_arrParam['form']);
                $validate->addRule('username', 'stringnotExistRecord', array('database'=>$this->_model, 'query'=>$queryUsername, 'min'=>3,'max'=>25))
                            ->addRule('email', 'emailnotExistRecord', array('database'=>$this->_model, 'query'=>$queryEmail))
                            ->addRule('password','password', array('action'=>'add'));
                        //deny là tập hợp giá trị ko hợp lệ
                $validate->run();
                $this->_arrParam['form'] = $validate->getResult();
                if($validate->isValid() == false){
                    $this->_view->errors =$validate->showErrorsPublic();
                }else{
                    $id = $this->_model->saveItem($this->_arrParam,array('task'=>'user-register'));
                    URL::redirect('default','index','notice',array('type'=>'register success'));
                   
                }
            }
            $this->_view->render('index/register');
        }
        public function indexAction(){
            $this->_view->render('index/index');
        }
        
    }