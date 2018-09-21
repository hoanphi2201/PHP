<?php
    class Auth{
        public static function checkLogin(){
            Session::Init();
            if(Session::get('loggedIn') == false){
                //chuyển đến trang login
                Session::destroy();
                header('location: index.php?controller=user&action=login');
                exit();
            }
        }
    }