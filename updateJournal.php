<?php
$page = "updateJournal.php";
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: login.php", true);
    exit();
}
$uId = $_SESSION['userId'];

$jId = $_POST['journalId'];
require('./partials/header.php');
require "config.php";
?>


<?php

// AND user_id=$uId
$q = "SELECT * from journals where journal_id=$jId";

$result = mysqli_query($conn, $q);

foreach ($result as $journal) {
?>

    <section id="updateForm" class="my-5">
        <div class="container">
            <div class="row">
                <form class="form-floating" action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $journal['journal_id']; ?>>
                    <div class=" form-floating mb-3">
                    <input type="text" class="form-control" name="journalTitle" id="floatingInput" spellcheck="false" value="<?php echo $journal['title']; ?>">
                    <label for="floatingInput">Title</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" spellcheck="false" name="journalDescription" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"><?php echo $journal['description']; ?></textarea>
                <label for="floatingTextarea2">Journal</label>
            </div>

            <a href="profile.php" type="btn" class="btn btn-danger">Cancel</a>
            <button type="submit" name="journalSubmit" class="btn btn-primary">Update</button>
            </form>
        </div>
        </div>
    </section>



<?php }

if (isset($_POST['journalSubmit'])) {
    $title = mysqli_real_escape_string($conn, (isset($_POST['journalTitle']) ? $_POST['journalTitle'] : ""));
    $description = mysqli_real_escape_string($conn, (isset($_POST['journalDescription']) ? $_POST['journalDescription'] : ""));
    $jId = $_POST['id'];

    $updateQuery = "UPDATE journals SET title= '$title', description= '$description', status='pending' WHERE journal_id= '$jId'";
    $fireQuery = mysqli_query($conn, $updateQuery);
    if ($fireQuery > 0) {
        echo "<script>window.location.assign('profile.php?updateMsg');</script>";
    } else {
        echo "There is an error : " . mysqli_error($conn);
    }
}

?>