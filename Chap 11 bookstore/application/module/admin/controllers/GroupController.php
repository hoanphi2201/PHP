<?php
    class GroupController extends Controller{
        public function __construct($arrParams){
            parent::__construct($arrParams);
            $this->_templateObj->setFolderTemplate('admin/main/');
            $this->_templateObj->setFileTemplate('index.php');
            $this->_templateObj->setFileConfig('template.ini');
            $this->_templateObj->load();
        }
        
        // Hiển thị danh sách group 
        public function indexAction(){
            $this->_view->_title = 'User Groups :: List';
            $totalItem = $this->_model->countItem($this->_arrParam,null); // tính tổng số
            //PAGINATION
            //Có thể thay đổi được
            $configPagination = array(
                                'totalItemsPerPage'=>3,
                                'pageRange'=>2,
                            );
            $this->setPagination($configPagination);
            $this->_view->pagination = new Pagination($totalItem, $this->_pagination);
            $this->_view->Items = $this->_model->listItem($this->_arrParam,null);
            $this->_view->render('group/index');
        }
        // ACTION : ADD GROUP & EDIT 
        public function formAction(){
            $this->_view->_title = 'User Manager: User Groups : Add';
            
            if(isset($this->_arrParam['id'])){
                $this->_view->_title = 'User Manager: User Groups : Edit';
                //lấy thông tin id
                $this->_arrParam['form'] = $data = $this->_model->infoItem($this->_arrParam);
                if(empty($this->_arrParam['form'])) URL::redirect('admin', 'group','index');
            }
            if(isset($this->_arrParam['form']['token']) &&$this->_arrParam['form']['token'] > 0){
                $source = $this->_arrParam['form'];
                $validate = new Validate($source);
                $validate->addRule('name', 'string', array('min' => 3, 'max' => 255))
                ->addRule('ordering', 'int', array('min' => 1, 'max' => 100))
                ->addRule('status', 'status', array('deny' => array('default')))
                ->addRule('group_acp', 'status', array('deny' => array('default')));
                        //deny là tập hợp giá trị ko hợp lệ
                $validate->run();
                $this->_arrParam['form'] = $validate->getResult();
                if($validate->isValid() == false){
                    $this->_view->errors =$validate->showErrors();
                }else{
                    // echo "<pre>";
                    // print_r($this->_arrParam);
                    // echo "</pre>";
                    //Ở đây nhận ra rằng khi ta thực hiện edit thì sẽ có id còn ko thì ko có
                     $task = ( isset($this->_arrParam['form']['id'])) ? 'edit' : 'add';
                     //die();
                    $id = $this->_model->saveItem($this->_arrParam,array('task'=>$task));
                    $type = $this->_arrParam['type'];
                   if($type == 'save-close'){
                        URL::redirect( 'admin', 'group','index');
                   }else if ($type == 'save-new'){
                        URL::redirect( 'admin', 'group','form');
                   }else if($type == 'save'){
                        URL::redirect( 'admin', 'group','form',array('id'=>$id));
                   }
                }

            }
            $this->_view->arrParam = $this->_arrParam;
            $this->_view->render('group/form');
        }
        public function logoutAction(){
            $this->_view->setTitle('Logout');
            $this->_view->render('user/logout');
        }
        //Hàm changeStatus sẽ gọi hàm bên model (*)
        public function ajaxStatusAction(){
            $result = $this->_model->changeStatus($this->_arrParam,array('task'=>'change-ajax-status'));
            echo json_encode($result);
        }
        //AJAX GROUP ACP (*)
        public function ajaxACPAction(){ 
            $result = $this->_model->changeStatus($this->_arrParam,array('task'=>'change-ajax-group-acp'));
            echo json_encode($result);
        }
         //ACTION STATUS 
         public function statusAction(){
            $this->_model->changeStatus($this->_arrParam,array('task'=>'change-status'));
            URL::redirect( 'admin', 'group','index');
        }
         //ACTION TRASH (*)
        public function trashAction(){
            $this->_model->deleteItem($this->_arrParam);
            URL::redirect( 'admin', 'group','index');
        }
         //ACTION ORDERING (*)
         public function orderingAction(){
            $this->_model->ordering($this->_arrParam);
            URL::redirect( 'admin', 'group','index');
        }
    }