<?php
    class Group_model extends Model{
        public function __construct(){
            //kế thừa từ model đã có controller -> đã có database 
            parent::__construct();
            $this->setTable('group');
        }
        public function listItems($option = null){
            $query2[] 	= "SELECT `g`.`id`,`g`.`name`,`g`.`status`,`g`.`ordering`, COUNT(`u`.id) AS total";
	        $query2[] 	= "FROM `group` AS `g` LEFT JOIN `user` AS `u` ON `g`.`id` = `u`.`group_id`";
	        $query2[] 	= "GROUP BY `g`.`id`";
            $query = implode(" ", $query2);
            $list = $this->listRecord($query);
           
           return $list;
        }
        public function deleteItem($id, $option = null){
            $this->delete(array($id));
        }
    }