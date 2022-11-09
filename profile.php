<?php
$page = "profile.php";
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: login.php", true);
    exit();
}
$uId = $_SESSION['userId'];
include "partials/header.php";
include "config.php";
$query = "select * from user where user_id=$uId";
$result = mysqli_query($conn, $query);

foreach ($result as $user) {

?>
    <section style="background-color: #eee;">
        <div class="container py-5">


            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4 style=" height : 400px"">
                        <div class="card-body text-center d-flex flex-column align-items-center">
                            <div class="img-container " style="width : 150px; height : 150px; overflow: hidden;">
                                <img src="userProfiles/<?php echo $user['userImage']; ?>" alt="avatar" class="avatar rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <h5 class="mb-3 mt-1"><?php echo $user['UserFName'] . " " . $user['userLName'];  ?></h5>


                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Change profile picture
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Image</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="d-flex flex-column  mb-2" action="" method="POST" enctype="multipart/form-data">
                                                <input class="form-control" name="userImg" type="file" id="formFile">

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="addImg" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                            <?php

                                            if (isset($_POST['addImg'])) {
                                                $pic = $_FILES['userImg']['name'];
                                                $newName = $uId . $pic;
                                                $location = $_FILES['userImg']['tmp_name'];
                                                $updateQuery = "UPDATE user SET userImage='$newName' where user_id= $uId";
                                                $exec = mysqli_query($conn, $updateQuery);
                                                if ($exec > 0) {
                                                    move_uploaded_file($location, 'userProfiles/' . $newName);
                                                } else {
                                                    echo "Error" . mysqli_error($conn);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card mb-4 py-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $user['UserFName'] . " " . $user['userLName'];  ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $user['userEmail']; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $user['userPhone'];  ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Gender</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $user['userGender'];
                                                            } ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>

  <!-- Delete Message   -->
    <?php
    if (isset($_GET['msg'])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <!-- <strong>Successfully Posted</strong> Journal is Added Succesfully -->
            Deleted Successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>
    <!-- Update message -->
    <?php
    if (isset($_GET['updateMsg'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Journal Updated Successfully</strong> Your Journal will be approved by admin after getting reviewed soon enough!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>


    <?php

    $q = "SELECT * from journals where status= 'approved' AND user_id=$uId order by date desc";

    $result = mysqli_query($conn, $q);

    foreach ($result as $journal) {
    ?>
        <section id="Posts ">
            <div class="container my-5">
                <div class="row">
                    <div class="card post-card">
                        <div class="card-header d-flex">
                            <!-- <div class="row"> -->
                            <div class="user-data d-flex">
                                <?php
                                $uId = $journal['user_id'];
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
                            <div class="dropdown dropstart options post-options">
                                <button class="btn rotate90 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="dots"></span>
                                    <span class="dots"></span>
                                    <span class="dots"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <!-- <button type="button" class="btn col-8 col-md-8 ms-5 text-center share-post-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Write a journal
                                        </button> -->
                                        <form action="updateJournal.php" method="POST">
                                            <input type="hidden" name="journalId" value="<?php echo $journal['journal_id']; ?>">
                                            <input class="dropdown-item btn" name="editJournal" type="submit" value="Edit" data-bs-toggle="modal" data-bs-target="#editJournalModal">
                                        </form>
                                    </li>
                                    <li>
                                        <form action="profile.php" method="POST">
                                            <input type="hidden" name="journalId" value="<?php echo $journal['journal_id']; ?>">
                                            <input class="dropdown-item btn" name="deleteJournal" type="submit" value="Delete">
                                        </form>

                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $journal['title']; ?></h5>
                            <p class="card-text"><?php echo substr($journal['description'], 0, 600) . " "; ?> <?php if (strlen($journal['description']) > 600) { ?><a href=class="text-decoration-none">read more....</a> <?php } ?></p>
                        </div>
                        <div class="card-footer d-flex">
                            <div class="likes pe-3 col-md-6 text-center">Likes</div>
                            <div class="comments px-3 col-md-6 text-center">Comments</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>


      
    
    <!-- ######################=====Events=======####################### -->
    <?php
    $q = "SELECT * FROM events WHERE status= 'approved' AND user_id=$uId order by date desc";

    $result = mysqli_query($conn, $q);

    foreach ($result as $event) {
    ?>

        <section id="Posts ">
            <div class="container my-5">
                <div class="row">
                    <div class="card post-card">
                        <div class="card-header d-flex">

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
                            <div class="dropdown dropstart options post-options">
                                <button class="btn rotate90 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="dots"></span>
                                    <span class="dots"></span>
                                    <span class="dots"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <form action="profile.php" method="POST">
                                            <input type="hidden" name="eventId" value="<?php echo $event['id']; ?>">
                                            <input class="dropdown-item btn" name="deleteEvent" type="submit" value="Delete">
                                        </form>
                                    </li>
                                </ul>

                            </div>

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
    <?php } ?>




    <div class="container">
        <div class="row mb-5">
            <form class="d-flex justify-content-center" action="" method="GET">
                <button class="btn btn-primary logout-btn w-75" name="logout" type="submit">Logout</button>
            </form>
            <?php
            if (isset($_GET['logout'])) {
                session_unset();
                session_destroy();
                echo "<script> window.location.assign('login.php');</script>";
            }
            ?>
        </div>
    </div>

    <?php
    // *************************Delete*******************************//
    if (isset($_POST['deleteJournal'])) {
        $id = $_POST['journalId'];

        $query = "DELETE FROM journals WHERE journal_id = $id";
        $exec = mysqli_query($conn, $query);
        if ($exec > 0) {
            echo "<script>window.location.assign('profile.php?msg')</script>";
        } else {
            echo "Error" . mysqli_error($conn);
        }
    }
    // Event Operation ---> should have made a different page for peforming operations.. :< #complexity issues.
    if (isset($_POST['deleteEvent'])) {
        $id = $_POST['eventId'];

        $query = "DELETE FROM events WHERE id = $id";
        $exec = mysqli_query($conn, $query);
        if ($exec > 0) {
            echo "<script>window.location.assign('profile.php?msg')</script>";
        } else {
            echo "Error" . mysqli_error($conn);
        }
    }

    include "partials/footer.php";

    ?>