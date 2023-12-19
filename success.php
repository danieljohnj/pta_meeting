<?php 


    $title='Success';
    require_once 'includes/header.php';
    require_once 'includes/db/conn.php';
    require_once 'sendemail.php';




    if(isset($_POST['submit'])){
        //extract values from the post array
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $dob   = $_POST['dob'];
        $email = $_POST['email'];
        $contact = $_POST['phone'];
        $choice = $_POST['choice'];

        $orig_file = $_FILES["avatar"]["tmp_name"];
        $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $target_dir = 'uploads/';
        $destination = "$target_dir$contact.$ext";
        move_uploaded_file($orig_file,$destination);

        
        //call function to insert and track if success or not
        $issuccess = $crud->insertAttendees($fname, $lname, $dob, $email, $contact, $choice, $destination);
        $choiceSelected = $crud->getChoiceById($choice);
        if($issuccess){
            sendemail::sendmail($email, 'Welcome to our 2023 PTA Meeting','you have registered successfully for this year IT conference');
            include 'includes/successmessage.php';
        }
        else{
            include 'includes/errormessage.php';
        }


    }
?>


            <img src=" <?php echo $destination; ?>"class= "rounded-circle" style="width: 20%; height: 20%" />
                <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $_POST['firstname'].'  '.$_POST['lastname']; ?>
                    
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?php echo $choiceSelected['name'];?>
                    </h6>
                    <p class="card-text">Date of Birth: <?php echo$_POST['dob'];?></p>
                    <p class="card-text">Email: <?php echo$_POST['email'];?></p>
                    <p class="card-text">Contact: <?php echo$_POST['phone'];?></p>
                    <a href="index.php" class="card-link">New Entry</a>
                </div>
            </div>

            

           




<br>
<br>
<br>
<br>
<br>
    <?php require_once 'includes/footer.php';

?>