<?php
$page = "event.php";
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: login.php", true);
    exit();
}
$uId = $_SESSION['userId'];

require('./partials/header.php');
require "config.php";

?>
<!-- title section -->
<section id="title">

    <div class="container">
        <div class="title-container col-lg-7 offset-lg-2 col-xl-7 offset-xl-4 pt-2 ">
            <h1>Event</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi obcaecati dicta sint blanditiis velit?</p>
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
                    <img src="userProfiles/<?php echo $userImage['userImage'];
                                        } ?>" class="profile-icon rounded-circle img-fluid" alt="icon">
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn col-8 col-md-8 ms-5 text-center share-post-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add an Event
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Event details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <input type="text" name="eName" spellcheck="false" class="form-control" id="exampleInputText" placeholder="Event Name">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="eLocation" spellcheck="false" class="form-control" id="exampleInputText" placeholder="Event Location">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="eType" spellcheck="false" class="form-control" id="exampleInputText" placeholder="Event Type">
                                </div>
                                <div class="mb-3">
                                    <input type="date" name="eDate" spellcheck="false" class="form-control" id="exampleInputText" placeholder="Event Date">
                                </div>
                                <div class="mb-3">
                                    <input type="time" name="eTime" spellcheck="false" class="form-control" id="exampleInputText" placeholder="Event Time">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="eRequirements" spellcheck="false" class="form-control" id="exampleInputText" placeholder="Event Requirements">
                                </div>
                                <div class="mb-3">
                                    <!-- <label for="message-text" class="col-form-label">Message:</label> -->
                                    <textarea class="form-control" spellcheck="false" name="eDesc" id="message-text" placeholder="Event Description" style="height:200px;"></textarea>
                                </div>

                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary">Add images</button> -->
                                    <button type="submit" name="eSubmit" class="btn btn-primary">Post</button>
                                </div>
                            </form>
                            <!-- Adding Form Data to Database. -->
                            <?php


                            if (isset($_POST['eSubmit'])) {
                                $eName = $_POST['eName'];
                                $eLocation = $_POST['eLocation'];
                                $eType = $_POST['eType'];
                                $eDate = $_POST['eDate'];
                                $eTime = $_POST['eTime'];
                                $eRequirements = $_POST['eRequirements'];
                                $eDesc = $_POST['eDesc'];
                                // $date = date('Y-m-d H:i:s'); // Not required anymore.
                                $InsertQuery = "Insert into `events` (`e_name`, `e_location`,`e_type`, `e_date`, `e_time`, `e_requirements`, `e_desc`,`user_id`)  values('$eName', '$eLocation', '$eType','$eDate','$eTime', '$eRequirements', '$eDesc', '$uId')";
                                $result = mysqli_query($conn, $InsertQuery);
                                if ($result > 0) {
                                    echo "Success";
                                } else {
                                    echo mysqli_error($conn);
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

<!-- Posts Section -->

<?php

$q = "select * from events where status= 'approved' order by date desc";

$result = mysqli_query($conn, $q);

foreach ($result as $event) {
?>

    <section id="Posts ">
        <div class="container my-5">
            <div class="row">
                <div class="card post-card">
                    <div class="card-header d-flex">
                        <!-- <div class="row"> -->
                        <div class="user-data d-flex">
                            <?php
                            $uId = $event['user_id'];
                            $query = "select UserFName,userLName,userImage from `user` WHERE user_id= $uId";
                            $exec = mysqli_query($conn, $query);

                            foreach ($exec as $value) {

                            ?>
                                <div class="profile-icon-container">
                                    <img src="userProfiles/<?php echo $value['userImage']; ?>" class="profile-icon img-fluid" alt="icon">
                                </div>
                                <div class="user-name-j-post">
                                    <p class="pt-2 ps-3 userName fw-semibold">
                                    <?php
                                    echo $value['UserFName'] . " " . $value['userLName'];
                                }
                                    ?>
                                    </p>
                                </div>
                        </div>
                        <!-- <div class="options btn post-options">
                            <span class="dots"></span>
                            <span class="dots"></span>
                            <span class="dots"></span>
                        </div> -->
                    </div>
                    <div class="card-body">

                        <div class="">
                            <h5><?php echo $event['e_name'] ?></h5>
                        </div>
                        <hr>
                        <div class="">
                            <h6><span class="event-descriptions">Event Date:</span><?php echo " " . $event['e_date'] ?></h6>
                        </div>
                        <hr>
                        <div class="">
                            <h6><span class="event-descriptions">Event Timing:</span><?php echo " " . $event['e_time'] ?></h6>
                        </div>
                        <hr>
                        <div class="">
                            <h6><span class="event-descriptions">Event Location: </span><?php echo " " . $event['e_location'] ?></h6>
                        </div>
                        <hr>
                        <div class="">
                            <h6><span class="event-descriptions">Event Type: </span><?php echo " " . $event['e_type'] ?></h6>
                        </div>
                        <hr>
                        <div class="">
                            <h6><span class="event-descriptions">Event Requirements: </span><?php echo " " . $event['e_requirements'] ?></h6>
                        </div>
                        <hr>
                        <div class=" mt-4">
                            <p><?php echo $event['e_desc'] ?></p>
                        </div>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="likes pe-3 col-md-6 text-center">Likes</div>
                        <div class="comments px-3 col-md-6 text-center">Comments</div>
                    </div>
                </div>
            </div>
        </div>
    </section>




<?php
}
require('./partials/footer.php');
?>