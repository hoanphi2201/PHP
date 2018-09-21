<?php
    class ErrorController extends Controller{
        public function __construct(){
            // parent::__construct();
            echo '<h3>' . __METHOD__ . '</h3>';
        }
        public function indexAction(){
            //do error kế thừa từ controller nên _view thuộc về lớp controller
            $this->_view->data = "<h3>This is an error</h3>";
            $this->_view->render('error/index');
        }
    }