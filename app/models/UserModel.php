<?php
/**
* class UserModel
*/
class UserModel extends DModel{
	
	public function __construct(){
	     parent::__construct();
	}

	public function userList($table){
	  $sql = "SELECT * FROM $table ORDER BY id DESC";	
	  return $this->db->select($sql);
	}



	public function userById($table,$id){
	  $sql = "SELECT * FROM $table WHERE id=:id";
	  $data = array(":id"=>$id);
	  return $this->db->select($sql,$data);
	}

	public function fetchById($table,$id){
	  $sql = "SELECT * FROM $table WHERE id=:id";
	  $data = array(":id"=>$id);
	  return $this->db->select($sql,$data);
	}	


	public function insertUser($table,$data){
		return $this->db->insert($table,$data);
	}

	public function userUpdate($table,$data,$cond){
		return $this->db->update($table,$data,$cond);
	}



	public function passUpdate($table,$data,$cond){
		return $this->db->update($table,$data,$cond);
	}

	public function delUserById($table,$cond){
		return $this->db->delete($table,$cond);		
	}


    function checkUserName($table,$username) {

		$sql   = "SELECT * FROM $table WHERE username =?";
	    $count = $this->db->chcekData($sql,$username);
        if ($count > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
?>