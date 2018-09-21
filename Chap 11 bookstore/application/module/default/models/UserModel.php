<?php   
    class UserModel extends Model{
	    private $_columns =  array(
                    'id', 
                    'username',
                    'email',
                    'fullname',
                    'password',
                    'created',
                    'created_by', 
                    'modified', 
                    'modified_by', 
                    'status', 
                    'register_date',
                    'register_ip',
                    'ordering', 
                    'group_id');        
        public function __construct(){
            parent::__construct();
            $this->setTable(TBL_USER);
        }
        public function saveItem($arrParam, $option = null){
            if($option['task'] == 'user-register'){
                 //kiểm tra vừa có trong $arrParam['form'] vừa có trong mảng
                 $arrParam['form']['register_date'] = date('Y-m-d : H:m:i', time());
                 $arrParam['form']['register_ip']   = $_SERVER['REMOTE_ADDR'];
                 $arrParam['form']['password']      = md5($arrParam['form']['password']);
                 $arrParam['form']['status']        = 0;
                 $data = array_intersect_key($arrParam['form'], array_flip($this->_columns)); 
                 
                 $this->insert($data);
                 return $this->lastID();
 
            }
        }
       
    }