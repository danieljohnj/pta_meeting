<?php 


    $title='Edit Record';
    require_once 'includes/header.php';
    require_once 'includes/db/conn.php';
    require_once 'includes/auth_check.php';

    $results = $crud->getChoices();

    if(!isset($_GET['id'])){

        include 'includes/errormessage.php';
        header("location: viewrecords.php");
    }
    else{

        $id = $_GET['id'];
        $attendee = $crud->getAttendeeDetails($id);
    
    
?>
        <h1 class="text-center">Edit Record</h1>
            <form method="post" action="editpost.php">
            <input type="hidden" name ="id" value ="<?php echo $attendee['attendee_id']?>" />
                <div class="form-group">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" value ="<?php echo $attendee['firstname']?>" id="firstname" placeholder="Entre First Name" name="firstname">
                   
                </div>

                <div class="form-group">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" value ="<?php echo $attendee['lastname']?>" id="lastname" placeholder="Entre Last Name" name="lastname">
                   
                </div>

                <div class="form-group">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="text" class="form-control" value ="<?php echo $attendee['dateofbirth']?>" id="dob" name="dob">
                   
                </div>

                <div class="form-group">
                    <label for="choice" class="form-label">Are you a:  </label>
                    <select class="form-control" value ="<?php echo $attendee['name']?>" id="choice" name="choice">
                      <?php while($r = $results->fetch(PDO::FETCH_ASSOC)) {?>
                            <option value ="<?php echo $r['choice_id']?>" <?php if($r['choice_id']==$attendee['choice_id']) echo 'selected' ?>>
                                <?php echo $r['name']; ?>
                            </option>
                        <?php }?>
                    </select>
                </div>



                <div class="form-group">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" value ="<?php echo $attendee['email']?>" id="email" aria-describedby="emailHelp" name="email">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" value ="<?php echo $attendee['contactnumber']?>"id="phone" aria-describedby="phoneHelp" name="phone">
                    <div id="phoneHelp" class="form-text">We'll never share your number with anyone else.</div>
                </div>

                
               
                <a href="viewrecords.php" class="btn btn-default ">back to list</button>
                <button type="submit" name="submit" class="btn btn-success ">Save Changes</button>

        </form>

<?php }?>
<br>
<br>
<br>
<br>
<br>
    <?php require_once 'includes/footer.php';

?>