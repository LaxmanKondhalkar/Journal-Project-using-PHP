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
            <strong>Message Sent Successfully</strong>
            We'll contact you back soon.
            <a type="button" href="diary.php" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
        </div>
<?php
    }
?>
<?php
    if (isset($_GET['failed'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Please Enter meaningful message.</strong>

            <a type="button" href="diary.php" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
        </div>
<?php
    }
?>

    <section id="updateForm" class="my-5">
        <div class="container">
            <div class="row">
                <form class="form-floating mb-3" action="" method="POST">
                    <div class=" form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="floatingInput" spellcheck="false" required>
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class=" form-floating mb-3">
                        <input type="text" class="form-control" name="subject" id="floatingInput" spellcheck="false" required>
                        <label for="floatingInput">Subject</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" spellcheck="false" required name="message" placeholder="Write Your Message here...." id="floatingTextarea2" style="height: 200px"></textarea>
                        <label for="floatingTextarea2">Message</label>
                    </div>

                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" name="contactSubmit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>



<?php 

if (isset($_POST['contactSubmit'])) {
    $email = $_POST['email'];
    $subject = mysqli_real_escape_string($conn, (isset($_POST['subject']) ? $_POST['subject'] : ""));
    $message = mysqli_real_escape_string($conn, (isset($_POST['message']) ? $_POST['message'] : ""));

    if(strlen($subject) < 10 && strlen($message) < 10){
        echo "<script>window.location.assign('contact.php?failed');</script>";
    }

    $insertQuery = "INSERT INTO contact_form (`user_id`, `subject`, `email`, `message`) VALUES ('$uId', '$subject', '$email', '$message')";
    $fireQuery = mysqli_query($conn, $insertQuery);
    if ($fireQuery > 0) {
        echo "<script>window.location.assign('contact.php?submitted');</script>";
    } else {
        echo "There is an error : " . mysqli_error($conn);
    }
}

include "./partials/footer.php";

?>
