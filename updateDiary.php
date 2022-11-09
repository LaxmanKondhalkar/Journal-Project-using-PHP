<?php
$page = "updateDiary.php";
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: login.php", true);
    exit();
}
$uId = $_SESSION['userId'];

$diaryId = $_POST['id'];
require('./partials/header.php');
require "config.php";
?>


<?php

// AND user_id=$uId
$q = "SELECT * from diary where diary_id=$diaryId";

$result = mysqli_query($conn, $q);

foreach ($result as $diary) {
?>

    <section id="updateForm" class="my-5">
        <div class="container">
            <div class="row">
                <form class="form-floating mb-3" action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $diary['diary_id']; ?>">
                    <div class=" form-floating mb-3">
                        <input type="text" class="form-control" name="diaryTitle" id="floatingInput" spellcheck="false" value="<?php echo $diary['title']; ?>">
                        <label for="floatingInput">Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" spellcheck="false" name="diaryDesc" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"><?php echo $diary['description']; ?></textarea>
                        <label for="floatingTextarea2">Diary</label>
                    </div>

                    <a href="diary.php" type="btn" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="diarySubmit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>



<?php }

if (isset($_POST['diarySubmit'])) {
    $title = mysqli_real_escape_string($conn, (isset($_POST['diaryTitle']) ? $_POST['diaryTitle'] : ""));
    $description = mysqli_real_escape_string($conn, (isset($_POST['diaryDesc']) ? $_POST['diaryDesc'] : ""));
    $diaryId = $_POST['id'];

    $updateQuery = "UPDATE diary SET title= '$title', description= '$description' WHERE diary_id= '$diaryId'";
    $fireQuery = mysqli_query($conn, $updateQuery);
    if ($fireQuery > 0) {
        echo "<script>window.location.assign('diary.php?updateMsg');</script>";
    } else {
        echo "There is an error : " . mysqli_error($conn);
    }
}

?>