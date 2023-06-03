<?php
$page = "contact.php";
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: login.php", true);
    exit();
}
$uId = $_SESSION['userId'];

require('./partials/header.php');
require "config.php";
?>

<?php
if (isset($_GET['submitted'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Message Sent Successfully!</strong> We'll contact you back soon.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}
?>

<?php
if (isset($_GET['failed'])) {
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Please Enter a Meaningful Message!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}
?>

<section id="updateForm" class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form class="mb-3" action="" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" spellcheck="false" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" spellcheck="false" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" spellcheck="false" required name="message" id="message" placeholder="Write Your Message here...." style="height: 200px"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary me-2">Reset</button>
                        <button type="submit" name="contactSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
if (isset($_POST['contactSubmit'])) {
    $email = $_POST['email'];
    $subject = mysqli_real_escape_string($conn, (isset($_POST['subject']) ? $_POST['subject'] : ""));
    $message = mysqli_real_escape_string($conn, (isset($_POST['message']) ? $_POST['message'] : ""));
    $status = "unread";

    if (strlen($subject) < 10 && strlen($message) < 10) {
        echo "<script>window.location.assign('contact.php?failed');</script>";
    }

    $insertQuery = "INSERT INTO contact_form (`user_id`, `subject`, `email`, `message`, `status`) VALUES ('$uId', '$subject', '$email', '$message', '$status')";
    $fireQuery = mysqli_query($conn, $insertQuery);
    if ($fireQuery > 0) {
        echo "<script>window.location.assign('contact.php?submitted');</script>";
    } else {
        echo "There is an error: " . mysqli_error($conn);
    }
}

require "./partials/footer.php";
?>