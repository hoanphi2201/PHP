<?php   
    class GroupModel extends Model{
	    private $_columns = array('id', 'name', 'group_acp', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering');        
        public function __construct(){
            parent::__construct();
            $this->setTable(TBL_GROUP);
        }
        public function countItem($arrParam, $option = null){
            // echo "<pre>";
            // print_r($arrParam);
            // echo "</pre>";
            $query[]	= "SELECT COUNT(`id`) AS `total`";
            $query[]	= "FROM `$this->table`";
            $query[]	= "WHERE `id` > 0";
             // FILTER KEYWORD filter_search
             if(!empty($arrParam['filter_search'])){
                $keyword	= '"%' . $arrParam['filter_search'] . '%"';
                $query[]	= "AND `name` LIKE $keyword";
            }
            // FILTER STATUS filter_state
            if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 'default'){
                $status = ($arrParam['filter_state']);
                $query[]	= "AND `status` = '" . $status ."'";

            }
              // FILTER GROUP ACP filter_state
            if(isset($arrParam['filter_group_acp']) && $arrParam['filter_group_acp'] != 'default'){
                $query[]	= "AND `group_acp` = '" . $arrParam['filter_group_acp'] ."'";
            }
           
            $query = implode(" ", $query);
            $result = $this->fetchRow($query);
            return $result['total'];

        }
        //LIST RECORD (lấy ra danh sách dữ liệu)
        public function listItem($arrParam, $option = null){
            // echo "<pre>";
            // print_r($arrParam);
            // echo "</pre>";
            $query[]	= "SELECT `id`, `name`, `group_acp`, `status`, `ordering`, `created`, `created_by`, `modified`, `modified_by`";
            $query[]	= "FROM `$this->table`";
		    $query[]	= "WHERE `id` > 0";

             // FILTER KEYWORD filter_search
             if(!empty($arrParam['filter_search'])){
                $keyword	= '"%' . $arrParam['filter_search'] . '%"';
                $query[]	= "AND `name` LIKE $keyword";
            }
            // FILTER STATUS filter_state
            if(isset($arrParam['filter_state']) && $arrParam['filter_state'] != 'default'){
                $status = ($arrParam['filter_state']);
                $query[]	= "AND `status` = '" .$status."'";
               
            }
            // FILTER GROUP ACP filter_state
            if(isset($arrParam['filter_group_acp']) && $arrParam['filter_group_acp'] != 'default'){
                $query[]	= "AND `group_acp` = '" . $arrParam['filter_group_acp'] ."'";                
            }
            //SORTER
            if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_column_dir'])){
                $column = $arrParam['filter_column'];
                $columnDir = $arrParam['filter_column_dir']; //ASC DESC
                $query[]	= "ORDER BY `$column` $columnDir";
            }else{
                $column = 'id';
                $columnDir = 'DESC'; //ASC DESC
                $query[]	= "ORDER BY `$column` $columnDir";
            }
            //PAGINATION 
            $pagination			= $arrParam['pagination'];
		    $totalItemsPerPage	= $pagination['totalItemsPerPage'];
		    if($totalItemsPerPage > 0){
			    $position	= ($pagination['currentPage']-1)*$totalItemsPerPage;
			    $query[]	= "LIMIT $position, $totalItemsPerPage";
		    }
            $query = implode(" ", $query);
            $result = $this->fetchAll($query);
            return $result;

        }
        //Change status (nếu là 1 cho về 0 và 0 thì cho trở lại 1)
        public function changeStatus($arrParam, $option = null){
            if($option['task'] == 'change-ajax-status'){
                //Lấy status mà người dùng chuyền cho mình
                $status = ($arrParam['status'] == 0) ? 1 : 0;
                $id  = $arrParam['id'];
                $query = "UPDATE `$this->table` SET `status` = $status WHERE `id`='".$id."'";
                $this->_query($query);

                $result = array(
                            'id'        =>$id, 
                            'status'    =>$status, 
                            'link'      =>URL::createLink('admin', 'group', 'ajaxStatus', array('id' => $id, 'status' => $status))
                        );
                Session::set('message', array('class'=>'success', 'content'=>'Phần tử đã được thay đổi Status'));
                return $result;
            }else if($option['task'] == 'change-ajax-group-acp'){
                // //Lấy groupacp mà người dùng chuyền cho mình
                $group_Acp = ($arrParam['group_acp'] == 0) ? 1 : 0;
                $id  = $arrParam['id'];
                $query = "UPDATE `$this->table` SET `group_acp` = $group_Acp WHERE `id`='".$id."'";
                $this->_query($query);

                $result =  array(
                            'id'        => $id, 
                            'group_acp' =>$group_Acp, 
                            'link'      =>URL::createLink('admin', 'group', 'ajaxACP', array('id' => $id, 'group_acp' => $group_Acp))
                );
                Session::set('message', array('class'=>'success', 'content'=>'Phần tử đã được thay đổi trạng thái Group Acp'));
                return $result;
                
            }else if($option['task'] == 'change-status'){
                // //Lấy groupacp mà người dùng chuyền cho mình
                $status = ($arrParam['type']);
                $id  = $arrParam['cid'];
                if(!empty($arrParam['cid'])){
                    $ids = $this->createWhereDeleteSQL($arrParam['cid']);
                    $query = "UPDATE `$this->table` SET `status` = $status WHERE `id` IN ($ids)";
                    $this->_query($query);
                    Session::set('message', array('class'=>'success', 'content'=>'Có '.$this->affectedRow().' dòng đã được cập nhật thành công'));
                }else{
                    Session::set('message', array('class'=>'error', 'content' => 'Vui lòng chọn phần tử muốn thay đổi trạng thái'));
                }
                
            }
        }
        public function deleteItem($arrParam, $option = null){
            if($option == null){
                if(!empty($arrParam['cid'])){
                    $ids = $this->createWhereDeleteSQL($arrParam['cid']);
                    echo $query = "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
                    $this->_query($query);
                    Session::set('message', array('class'=>'success', 'content'=>'Có '.$this->affectedRow().' dòng đã được xoá thành công'));
                    
                }else{
                    Session::set('message', array('class'=>'error', 'content' => 'Vui lòng chọn phần tử muốn xoá'));
                }
            }
        }
        public function ordering($arrParam, $option = null){
            if($option == null){
                if(!empty($arrParam['order'])){
                    $i = 0;
                    foreach($arrParam['order'] as $id => $ordering){
                        $i++;
                        $query	= "UPDATE `$this->table` SET `ordering` = $ordering WHERE `id` = '" . $id . "'";
                        $this->_query($query);
                    }
                    Session::set('message', array('class' => 'success', 'content' => 'Có ' .$i. ' phần tử được thay đổi  ordering!'));
                }
            }
        }
        public function saveItem($arrParam, $option = null){
           if($option['task'] == 'add'){
                //kiểm tra vừa có trong $arrParam['form'] vừa có trong mảng
                $arrParam['form']['created'] = date('d-m-Y', time());
                $arrParam['form']['created'] = 1;

                $data = array_intersect_key($arrParam['form'], array_flip($this->_columns)); 
                
                $this->insert($data);
                Session::set('message', array('class'=>'success', 'content'=>'Dữ liệu được lưu thành công'));
                return $this->lastID();

           }else if($option['task'] == 'edit'){
            //kiểm tra vừa có trong $arrParam['form'] vừa có trong mảng
            $arrParam['form']['modified']	= date('Y-m-d', time());
			$arrParam['form']['modified_by']= 10;
            $data	= array_intersect_key($arrParam['form'], array_flip($this->_columns));
            
			$this->update($data, array(array('id', $arrParam['form']['id'])));
			Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
			return $arrParam['form']['id'];

       }
        }
        public function infoItem($arrParam, $option = null){
            if($option == null){
                $query[]	= "SELECT `id`, `name`, `group_acp`, `status`, `ordering`";
                $query[]	= "FROM `$this->table`";
                $query[]    = "WHERE `id` = '" . $arrParam['id'] . "'";

                $query      = implode(" ", $query);
                $result     =  $this->fetchRow($query);
                return $result;
            }
        }
        
        
    }