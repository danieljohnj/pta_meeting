<?php
    require_once 'includes/auth_check.php';
    require_once 'includes/db/conn.php';
    if(!$_GET['id']){

        include 'includes/errormessage.php';
        header("location: viewrecords.php");

    }else{  //get id value
            $id = $_GET['id'];
            //call delete function
            $result = $crud->deleteAttendee($id);

            //redirect to list
            if($result)
            {
                header("Location: viewrecords.php");
            }
            else{
                include 'includes/errormessage.php';
            }

    }


