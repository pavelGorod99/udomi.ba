<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class PetsDao extends BaseDao{

  public function get_all_pets(){
    return $this->query_no_params("SELECT * FROM pets");
  }

  public function get_pet_by_id($id){
  }

}

?>
