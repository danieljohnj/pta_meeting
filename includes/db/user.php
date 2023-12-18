<?php
    class user{
        //private datebase object
        private $db;

        //coonstructor to initialize private variable to the database connection
        function __construct($conn){
            $this->db = $conn;

            }

            public function insertUser($username, $password){

                try {
                    $result = $this->getUserbyusername($username);
                    if($result['num'] > 0){
                        return false;
                    }else{
                        $new_password = md5($password.$username);
                            //define sql statement to be executed
                            $sql ="INSERT INTO users (username, password) VALUES (:username,:password)";
                            //bind all placeholders to the actual values
                            $stmt = $this->db->prepare($sql);
                            //binds all placeholder to the actual value
                            $stmt->bindparam(':username' ,$username);
                            $stmt->bindparam(':password' ,$new_password);
                            //execute statement
                            $stmt->execute();
                            return true;
                    }
                        } catch (PDOException $e) {
                            echo $e->getMessage();
                            return false;
                }


            }

            public function getUser($username, $password){

                try{
                    $sql = "SELECT * FROM users where username = :username AND password = :password ";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindparam(':username', $username);
                    $stmt->bindparam(':password', $password);
                    $stmt->execute();
                    $result = $stmt->fetch();
                    return $result;

                }catch(PDOException $e) {
                    echo $e->getMessage();
                    return false;

                }


            }
            public function getUserbyusername($username){
                try{
                    $sql = "select count(*) as num from users where username = :username";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindparam(':username', $username);
                    $stmt->execute();
                    $result = $stmt->fetch();
                    return $result;

                }catch(PDOException $e) {
                    echo $e->getMessage();
                    return false;

                }
   

            }

            public function getUsers(){
                try{
                    $sql = "SELECT * FROM users";
                    $result = $this->db->query($sql);
                    return $result;
                }catch(PDOException $e){
                    echo $e->getMessage();
                    return false;
                }
            }

        }

?>