<?php
include "Db.php";

    class Contact extends Db{
        public function add_contact_us($firstname, $lastname, $email, $comment){
            $sql = "INSERT INTO contact_us(firstname, lastname, email, comment) VALUES(?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(1, $firstname, PDO::PARAM_STR);
            $stmt->bindParam(2, $lastname, PDO::PARAM_STR);
            $stmt->bindParam(3, $email, PDO::PARAM_STR);
            $stmt->bindParam(4, $comment, PDO::PARAM_STR);
            $contact_added = $stmt->execute();
                if ($contact_added) {
                    return true;
                }else{
                    return false;
                }
        }
    
        public function fetch_contact_us(){
            $sql = "SELECT * FROM contact_us";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $success = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $success;
        }
    
                //DELETE CONTACT US
        public function delete_contact_us($contact_us_id){
            $sql = "DELETE FROM contact_us WHERE contact_us_id =?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(1, $contact_us_id, PDO::PARAM_INT);
            $deleted = $stmt->execute();
            return $deleted;
        }
    }

?>