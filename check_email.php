<?php
// check_email.php
require_once 'includes/db/conn.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Check if the email already exists
    $emailExists = $crud->checkEmailExistence($email);

    if ($emailExists) {
        echo "exists";
    } else {
        echo "not exists";
    }
} else {
    echo "Invalid request";
}
?>
