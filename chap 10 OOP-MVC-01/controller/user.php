<?php
    class User extends Controller{
        public function __construct(){
            parent::__construct();
            Session::Init();
        }
        public function login(){ // hien thi danh sach menu
            // echo "<pre>";
            // print_r($this->database);
            // echo "</pre>";
            if(Session::get('loggedIn') == true){
                //chuyển đến trang login
                $this->redirect('group','index');
            }
            if(isset($_POST['submit'])){
                $source     = array('username'=>$_POST['username']);
                $username   = $_POST['username'];
                $password   = md5($_POST['password']); 
                $validate   = new Validate($source);
                $query = "SELECT `id` FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
                $validate->addRule('username', 'existRecord', array('database'=>$this->database, 'query'=>$query));
                $validate->run();

                if($validate->isValid() ==true){
                    //đăng nhập thành công chuyển đến trang group
                    Session::set('loggedIn',true);
                    $this->redirect('group','index');
                    //Dùng session để xem rằng người dùng đã đăng nhập chưa
                   
                }else{
                    //đăng nhập thất bại chuyển error về để view
                    $this->view->errors =$validate->showErrors();
                }
                
            }
            $this->view->render('user/login');

        }
        public function logout(){
            $this->view->render('user/logout');
            Session::destroy();
        }
    }