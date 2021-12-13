<?php
    class crud{
        // private database object\
        private $db;

        //constructor to initialize private variable to the database connection
        function __construct($conn){
            $this->db = $conn;
        }

        public function insertAttendees($fname, $lname, $dob, $email, $contact, $specialty){
            try{
                // define sql statements to be executed
                $sql = "INSERT INTO attendee (firstname, lastname,dateofbirth, emailaddress, 
                contactnumber, specialty_id) VALUES(:fname,:lname,:dob,:email,:contact,:specialty) ";
               //prepare the sql statement foe execution
                $stnt = $this->db->prepare($sql);
                //bind all placeholders to the actual values
                $stnt->bindparam(':fname',$fname);
                $stnt->bindparam('lname',$lname);
                $stnt->bindparam(':dob',$dob);
                $stnt->bindparam(':email',$email);
                $stnt->bindparam(':contact',$contact);
                $stnt->bindparam(':specialty',$specialty);

                $stnt->execute();

                return true;

            }  catch(PDOException $e) {
                echo $e->getMessage();
                return false;
            }  
        } 

        public function editAttendees($id, $fname, $lname, $dob, $email, $contact, $specialty){
            try{
                $sql = "UPDATE `attendee` SET `firstname`=:fname,`lastname`=:lname,`dateofbirth`=:dob,
                `emailaddress`=:email,`contactnumber`=:contact,`specialty_id`=:specialty WHERE attendee_id =
                :id ";
                 $stnt = $this->db->prepare($sql);
                 //bind all placeholders to the actual values
                 $stnt->bindparam(':id',$id);
                 $stnt->bindparam(':fname',$fname);
                 $stnt->bindparam('lname',$lname);
                 $stnt->bindparam(':dob',$dob);
                 $stnt->bindparam(':email',$email);
                 $stnt->bindparam(':contact',$contact);
                 $stnt->bindparam(':specialty',$specialty);
                 
                 $stnt->execute();
                 return true;

            }catch(PDOException $e) {
                echo $e->getMessage();
                return false;

            }

                
        }

        public function getAttendees(){
           try{
            $sql = "SELECT * FROM `attendee` a inner join specialties s on a.specialty_id = s.specialty_id";
            $result = $this->db->query($sql);
            return $result;
           }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
           }

        }

        public function getAttendeeDetails($id){
            try{
                $sql = "select * from attendee a inner join specialties s on a.specialty_id =s.specialty_id
                where attendee_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }

        }

        public function deleteAttendee($id){
           try{
                 $sql = "Delete from attendee where attendee_id = :id";
                 $stmt = $this->db->prepare($sql);
                 $stmt->bindparam(':id', $id);
                 $stmt->execute();
                 return true;
           }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
           }

        }


        public function getSpecialties(){
            try{
                $sql = "SELECT * FROM `specialties`;";
                $result = $this->db->query($sql);
                return $result;
            }catch(PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getSpecialtyById($id){
            try{
                $sql = "SELECT * FROM `specialties` where specialty_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(":id", $id);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            }catch(PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

    }


?>