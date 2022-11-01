<?php
$page = "user_events.php";
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: login.php", true);
    exit();
}
$uId = $_SESSION['userId'];

require '../config.php';
include "iframe_header.php"; 

?>

<?php

// $q = "select * from journals where user_id = $uId";
$q = "SELECT * from events WHERE status= 'approved' AND user_id=$uId order by date desc";

$result = mysqli_query($conn, $q);

foreach ($result as $event) {
    // if($journal > 1){
?>
    <section id="journal-posts" class="my-4 p-4">
        <div class="container j-container w-75">
            <div class="j-post p-4 ">
                <!-- Journal Post header section -->
                <div class="j-post-header d-flex offset-lg-1">
                    <!-- user image and name -->
                    <div class="user-data d-flex justify-content-end me-5">
                        <?php
                            $uId = $event['user_id'];
                            $query = "select UserFName,userLName,userImage from `user` WHERE user_id= $uId";
                            $exec = mysqli_query($conn, $query);

                            foreach ($exec as $value) {

                        ?>
                            <div class="profile-icon-container">
                                <img src="../userProfiles/<?php echo $value['userImage']; ?>" class="profile-icon img-fluid" alt="icon">
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
                    <!-- date of journal and options btn  -->
                    <div class="j-date-and-options d-flex col-sm-5 col-md-7 justify-content-end">
                        <!-- <div class="date d-flex  me-5">
                                <p class="pt-2">1/1/11</p>
                            </div> -->
                        <!-- <div class="options btn">
                            <span class="dots"></span>
                            <span class="dots"></span>
                            <span class="dots"></span>
                        </div> -->
                    </div>
                </div>
                <!-- Journal title and content. -->
                <div class="journal-title-and-content col-lg-10 offset-lg-1 mt-4">
                <div class="">
                    <h5><?php echo $event['e_name'] ?></h5>
                </div>
                <hr>
                <div class="">
                    <h6><span class="event-descriptions">Event Date:</span><?php echo " ".$event['e_date'] ?></h6>
                </div>
                <hr>
                <div class="">
                    <h6><span class="event-descriptions">Event Timing:</span><?php echo " ".$event['e_time'] ?></h6>
                </div>
                <hr>
                <div class="">
                    <h6><span class="event-descriptions">Event Location: </span><?php echo " ".$event['e_location'] ?></h6>
                </div>
                <hr>
                <div class="">
                    <h6><span class="event-descriptions">Event Type: </span><?php echo " ".$event['e_type'] ?></h6>
                </div>
                <hr>
                <div class="">
                    <h6><span class="event-descriptions">Event Requirements: </span><?php echo " ".$event['e_requirements'] ?></h6>
                </div>
                <hr>
                <div class=" mt-4">
                    <p><?php echo $event['e_desc'] ?></p>
                </div>
            </div>
            <div class="j-like-section offset-lg-1 mt-4 ">
                <div class="btn j-like-btn d-flex align-items-center col-md-1 px-0">
                    <img src="../assets/images/heart-solid.svg" class="j-like-btn-img" alt="like">
                    <p class="ms-2">Like</p>
                </div>
            </div>
            </div>
        </div>
    </section>
<?php 
    
    // }
}
?>
</body>
</html>