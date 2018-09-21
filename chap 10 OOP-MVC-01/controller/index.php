<?php
    class Index extends Controller{
        public function __construct(){
            parent::__construct();
            //echo '<h3>' . __METHOD__ .'</h3>';
        }
        public function index(){ // hien thi danh sach menu
           // echo '<h3>' . __METHOD__ .'</h3>';
            $this->view->title='Home';
            $this->view->render('index/index');
            
        }
        
    }