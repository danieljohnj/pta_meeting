<?php
$title = 'Success';
require_once 'includes/header.php';
require_once 'includes/db/conn.php';
require_once 'sendemail.php';

if (isset($_POST['submit'])) {
    // Extract values from the post array
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $contact = $_POST['phone'];
    $choice = $_POST['choice'];
    $gender = $_POST['gender'];

    // Use a timestamp as part of the filename to make it unique
    $timestamp = time();
    $orig_file = $_FILES["avatar"]["tmp_name"];
    $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
    $target_dir = 'uploads/';
    $destination = "$target_dir$timestamp.$ext";
    move_uploaded_file($orig_file, $destination);

    // Call function to insert and track if success or not
    $issuccess = $crud->insertAttendees($fname, $lname, $dob, $email, $contact, $choice, $gender, $destination);
    $choiceSelected = $crud->getChoiceById($choice);
    $genderSelected = $crud->getGenderById($gender);

    if ($issuccess) {
        sendemail::sendmail($email, 'Welcome to our 2023 PTA Meeting', 'You have registered successfully');
?>

        <img src="<?php echo empty($destination) ? "uploads/7777777.jpg" : $destination; ?>" class="rounded-circle" style="width: 20%; height: 20%" />

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $_POST['firstname'] . '  ' . $_POST['lastname']; ?>
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    <?php echo $choiceSelected['name'] . ' - ' . $genderSelected['gen']; ?>
                </h6>
                <p class="card-text">Date of Birth: <?php echo $_POST['dob']; ?></p>
                <p class="card-text">Email: <?php echo $_POST['email']; ?></p>
                <p class="card-text">Contact: <?php echo $_POST['phone']; ?></p>
                <a href="index.php" class="card-link">New Entry</a>
            </div>
        </div>

<?php
    } else {
        include 'includes/errormessage.php';
    }
}
?>

<br>
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>
