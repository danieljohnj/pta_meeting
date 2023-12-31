<?php


    class crud{
        //private datebase object
                private $db;

                //coonstructor to initialize private variable to the database connection
                function __construct($conn){
                    $this->db = $conn;

                    }

                    public function insertAttendees($fname, $lname, $dob, $email, $contact, $choice, $gender, $avatar_path)
                    {
                        try {
                        //define sql statement to be executed
                        $sql = "INSERT INTO parent_attendee (firstname, lastname, dateofbirth, email, contactnumber, choice_id, gender_id, avatar_path) 
                        VALUES (:fname, :lname, :dob, :email, :contact, :choice, :gender, :avatar_path)";                        //bind all placeholders to the actual values
                        $stmt = $this->db->prepare($sql);
                        //binds all placeholder to the actual value
                        $stmt->bindparam(':fname' ,$fname);
                        $stmt->bindparam(':lname' ,$lname);
                        $stmt->bindparam(':dob' ,$dob);
                        $stmt->bindparam(':email' ,$email);
                        $stmt->bindparam(':contact' ,$contact);
                        $stmt->bindparam(':choice' ,$choice);
                        $stmt->bindparam(':avatar_path' ,$avatar_path);
                        $stmt->bindparam(':gender', $gender);

                        //execute statement
                        $stmt->execute();
                        return true;

                    } catch (PDOException $e) {
                        echo $e->getMessage();
                        return false;
                    }
                }
                
                public function editAttendee($id, $fname, $lname, $dob, $email, $contact, $choice, $gender)
                {
                    try {
                                $sql = "UPDATE `parent_attendee` SET `firstname`= :fname, `lastname`= :lname, `dateofbirth`= :dob, 
                                `email`= :email, `contactnumber`= :contact, `choice_id`= :choice, `gender_id`= :gender 
                                WHERE attendee_id = :id";                                
                                
                                $stmt = $this->db->prepare($sql);
                                //binds all placeholder to the actual value
                                $stmt->bindparam(':id' ,$id);                          
                                $stmt->bindparam(':fname' ,$fname);
                                $stmt->bindparam(':lname' ,$lname);
                                $stmt->bindparam(':dob' ,$dob);
                                $stmt->bindparam(':email' ,$email);
                                $stmt->bindparam(':contact' ,$contact);
                                $stmt->bindparam(':choice' ,$choice);
                                $stmt->bindparam(':gender', $gender);
                                //execute statement
                                $stmt->execute();
                                return true;

                    }catch(PDOException $e) {
                        echo $e->getMessage();
                        return false;

                    }
                }
                   

                
                    public function getAttendees(){
                        try {
                            $sql = "SELECT a.*, s.name, g.gen FROM parent_attendee a 
                                    INNER JOIN choices s ON a.choice_id = s.choice_id
                                    LEFT JOIN genders g ON a.gender_id = g.gender_id";
                            $result = $this->db->query($sql);
                            return $result;
                        } catch (PDOException $e) {
                            echo $e->getMessage();
                            return false;
                        }
                    }
                        
                        

                



        public function checkEmailExistence($email) {
            try {
                $sql = "SELECT COUNT(*) FROM parent_attendee WHERE email = :email";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $count = $stmt->fetchColumn();

                return $count > 0; // Return true if email exists, false otherwise
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }




                
                

                public function getAttendeeDetails($id){
                   try{
                        $sql = "SELECT * FROM parent_attendee  a inner join choices s on a.choice_id = s.choice_id   where attendee_id = :id";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindparam(':id', $id);
                        $stmt->execute();
                        $result = $stmt->fetch();
                        return $result;

                    }catch(PDOException $e) {
                        echo $e->getMessage();
                        return false;

                    }
                    
                }

                public function deleteAttendee($id){
                    try {
                        $sql = "DELETE FROM parent_attendee WHERE attendee_id = :id";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindparam(':id', $id);
                        $stmt->execute();
                        return true;
                    } catch(PDOException $e) {
                        echo $e->getMessage();
                        return false;
                    }
                }

                public function getChoices(){ //public function getSpecialties(){

                    try{
                        $sql = "SELECT * FROM `choices`";
                        $result = $this->db->query($sql);
                        return $result;

                    }catch(PDOException $e) {
                        echo $e->getMessage();
                        return false;

                    }

                }

                public function getChoiceById($id){  //public function getSpecialtyById
                    try{
                        $sql = "SELECT * FROM `choices` where choice_id = :id";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindparam(':id', $id);
                        $stmt->execute();
                        $result = $stmt->fetch();
                        return $result;

                    }catch(PDOException $e) {
                        echo $e->getMessage();
                        return false;

                    }

                }



                public function getGenders()
                {
                    try {
                        $sql = "SELECT * FROM `genders`";
                        $result = $this->db->query($sql);
                        return $result;
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                        return false;
                    }
                }

                public function getGenderById($id)
                {
                    try {
                        $sql = "SELECT * FROM `genders` WHERE gender_id = :id";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $result = $stmt->fetch();
                        return $result;
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                        return false;
                    }
                }




                
            }

?>