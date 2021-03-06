<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/BaseDao.class.php";

class PetsDao extends BaseDao{
  /*
  * Returns all pets
  */
  public function get_all_pets(){
    return $this->query_no_params("SELECT * FROM pets");
  }
  /*
  * Returns the pet with the queried id
  */
  public function get_pet_by_id($pet_id){
    return $this->query_with_params("SELECT * FROM pets WHERE pets_id = :id",[ 'id' => $pet_id ]);
  }
  /*
  * Returns all pets which are vaccinated, by calling on query_with_params from BaseDao
  */
  public function get_pets_by_vaccine($vaccinated){
    return $this->query_with_params("SELECT * FROM pets WHERE vaccinated = :vaccinated", [ 'vaccinated' => $vaccinated]);
  }

  //get pets older
  public function get_older_pets($timestamp){
    return $this->query_with_params("SELECT * FROM pets WHERE pet_birthdate < :timestamp", ['timestamp' => $timestamp]);
  }

  //get pets younger
  public function get_younger_pets($timestamp){
    return $this->query_with_params("SELECT * FROM pets WHERE pet_birthdate > :timestamp", ['timestamp' => $timestamp]);
  }

  // get by gender
  public function get_by_gender($gender){
    return $this->query_with_params("SELECT * FROM pets WHERE pet_gender = :gender", ['gender' => $gender]);
  }

  //insert new pet in database
  public function insert_pet($params){
    $sql = "INSERT INTO pets (petname, pet_birthdate, vaccinated, owner_id, species_id, photos_url, pets_description, pet_gender) VALUES (:petname, :pet_birthdate, :vaccinated, :owner_id, :species_id, :photos_url, :pets_description, :pet_gender)";
    $res = $this->conn->prepare($sql);
    $res->execute($params);
    $params['pets_id'] = $this->conn->lastInsertId();
    return $params;
  }
}
?>
