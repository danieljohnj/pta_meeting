<?php
    require_once 'includes/db/conn.php';


        //get value from post operation
        if(isset($_POST['submit'])){
            //extract values from the post array
            $id = $_POST['id'];
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $dob   = $_POST['dob'];
            $email = $_POST['email'];
            $contact = $_POST['phone'];
            $choice = $_POST['choice'];
        
        //call crud function

        $result = $crud->editAttendee($id, $fname, $lname, $dob, $email, $contact, $choice);



        //redirect to index.php
        if($result){
            header("Location: viewrecords.php");

        }else{
            include 'includes/errormessage.php';
        }

     }
    else{
        include 'includes/errormessage.php';
     }









?>
