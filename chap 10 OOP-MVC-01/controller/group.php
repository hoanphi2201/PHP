<?php
    class Group extends Controller{
        public function __construct(){
            parent::__construct();
            Auth::checkLogin();

        }
        public function index(){
            // require_once 'models/group_model.php';
            // $group = new Group_model();

            $this ->view->items=$this->database->listItems();
            //cách load 1 file js hoặc css 
            $this->view->js = array('group/js/group.js', 'group/js/jquery-ui-1.10.3.custom.min.js');
            $this->view->css = array('group/css/jquery-ui-1.10.3.custom.min.css');
            //tuyền title về view
            $this->view->title='Group';
            $this->view->render('group/index');

        }
        public function delete(){
            if(isset($_POST['id'])){
                $this->database->deleteItem($_POST['id']);
            }
        }
        public function add(){
            echo '<h3>' . __METHOD__ .'</h3>';
        }
    }