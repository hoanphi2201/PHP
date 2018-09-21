<?php
   class Error_MVC extends Controller{
      public function index(){
            $this->view->msg = 'This is an error !';
            $this->view->render('error/index');
       }
   }