<?php
require "config.php";
$page = "diary.php";
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: login.php", true);
    exit();
}
$timezone = date_default_timezone_set("Asia/Calcutta");
$uId = $_SESSION['userId'];
$_SESSION['currDate'] = date('Y-m-d');
$dateExist = false;

$checkDate = "SELECT DATE_FORMAT(date, '%Y-%m-%d') DATEONLY from diary where user_id = $uId";
$dates = mysqli_query($conn, $checkDate);

// echo $_SESSION['currDate']."<br>"; 
foreach ($dates as $date) {
    // echo $date['DATEONLY']."<br>";
    if ($date['DATEONLY'] == $_SESSION['currDate']) {
        // echo "Date exist show the diary content and append the new ones if there.";
        $dateExist = true;
    } else {
        echo mysqli_error($conn);
        // print_r($date['DATEONLY']); 
    }
}

require('./partials/header.php');
?>
<!-- title section -->
<section id="title">

    <div class="container">
        <div class="title-container col-lg-7 offset-lg-2 col-xl-7 offset-xl-4 pt-2 ">
            <h1>Write Diary everyday.</h1>
            <p>Diaries is personal to every user this will not be shared to anyone else. User can write a diary every day.</p>
        </div>
    </div>
</section>

<!-- content section -->

<section id="create-post" class="my-4 p-4">
    <div class="container c-p-container">
        <div class="create-post-container p-4 d-flex ">
            <div class="profile-icon-container offset-md-1">
                <?php
                $selectUserImg = "SELECT userImage FROM user WHERE user_id = $uId";
                $fireQuery = mysqli_query($conn, $selectUserImg);
                foreach ($fireQuery as $userImage) {
                ?>
                    <img src="./userProfiles/<?php echo $userImage['userImage'];
                                            } ?>" class="profile-icon rounded-circle img-fluid" alt="icon">
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn col-8 col-md-8 ms-5 text-center share-post-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Write Today's Diary.
            </button>

            <!-- Modal -->

            <!-- <?php
                    // $showData = "Select * from diary where user_id = $uId"; 
                    ?> -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Write Today's Diary.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <input type="text" name="diaryTitle" class="form-control" id="exampleInputText" spellcheck="false" placeholder="Diary Title">
                                </div>
                                <div class="mb-3">
                                    <!-- <label for="message-text" class="col-form-label">Message:</label> -->
                                    <textarea class="form-control" name="diaryDesc" id="message-text" spellcheck="false" placeholder="Write here..."></textarea>
                                </div>

                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary">Add images</button> -->
                                    <button type="submit" name="diarySubmit" class="btn btn-primary">Post</button>
                                </div>
                            </form>
                            <?php
                            // $date = date('Y-m-d H:i:s'); // Not required anymore.
                            $title = mysqli_real_escape_string($conn, (isset($_POST['diaryTitle']) ? $_POST['diaryTitle'] : ""));
                            $description = mysqli_real_escape_string($conn, (isset($_POST['diaryDesc']) ? $_POST['diaryDesc'] : ""));


                            if (isset($_POST['diarySubmit']) && $dateExist == false && strlen($_POST['diaryTitle']) > 0 && strlen($_POST['diaryDesc']) > 0) {
                                $q = "Insert into `diary` (`title`,`description`, `user_id`) values ('$title','$description', '$uId')";

                                $result = mysqli_query($conn, $q);

                                if ($result > 0) {
                                    // echo "Diary Added Successfully";
                                    echo "<script> window.location.assign('diary.php?diaryAdded');</script>";
                                } else {
                                    // echo "insertion failed <br>";
                                    // echo mysqli_error($conn);
                                    // echo "<br>";
                                    // print_r($result);
                                    echo "<script> window.location.assign('diary.php?insertionFailed');</script>";
                                    
                                }
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- For success message -->
<?php
    if (isset($_GET['diaryAdded'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <!-- <strong>Successfully Posted</strong> Journal is Added Succesfully -->
            Diary Added Succesfully.
            <a type="button" href="diary.php" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
        </div>
<?php
    }
?>
<!-- For Failure -->
<?php
    if (isset($_GET['insertionFailed'])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <!-- <strong>Successfully Posted</strong> Journal is Added Succesfully -->
                Couldn't Insert the diary. 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php
    }
?>
    <!-- For successfully Deleted. Message -->
<?php
    if (isset($_GET['deleted'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <!-- <strong>Successfully Posted</strong> Journal is Added Succesfully -->
            Deleted Successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>

<?php
$query = "select * from diary where user_id=$uId order by date desc";
$result = mysqli_query($conn, $query);
foreach ($result as $diary) {
?>
    <section id="Posts ">
        <div class="container my-5">
            <div class="row">
                <div class="card post-card">
                    <div class="card-header d-flex">
                        <h3><?php echo date('j F Y, l', strtotime($diary['date'])); ?> </h3>

                        <div class="dropdown dropstart options post-options">
                            <button class="btn rotate90 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="dots"></span>
                                <span class="dots"></span>
                                <span class="dots"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <form action="diary.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $diary['diary_id']; ?>">
                                        <input class="dropdown-item btn" name="EditDiary" type="submit" value="Edit">
                                    </form>

                                </li>
                                <li>
                                    <form action="diary.php" method="POST">
                                        <input type="hidden" name="diaryId" value="<?php echo $diary['diary_id']; ?>">
                                        <input class="dropdown-item btn" name="deleteDiary" type="submit" value="Delete">
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $diary['title'];  ?></h5>
                        <p class="card-text"><?php echo substr($diary['description'], 0, 600) . " "; ?> <?php if(strlen($diary['description']) > 600) {?><a href=class="text-decoration-none">read more....</a> <?php } ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
}

if (isset($_POST['deleteDiary'])) {
    $id = $_POST['diaryId'];

    $query = "DELETE FROM diary WHERE diary_id = $id";
    $exec = mysqli_query($conn, $query);
    if ($exec > 0) {
        echo "<script>window.location.assign('diary.php?deleted')</script>";
    } else {
        echo "Error" . mysqli_error($conn);
    }
}
require('./partials/footer.php');
?>