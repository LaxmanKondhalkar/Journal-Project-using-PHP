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
    <?php
    // AND user_id=$uId
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
                            <div class="options btn post-options">
                                <span class="dots"></span>
                                <span class="dots"></span>
                                <span class="dots"></span>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="card-body">

                            <h5 class="card-title"><?php echo $journal['title']; ?></h5>
                            <p class="card-text"><?php echo $journal['description']; ?></p>
                            <a href="#" class="">Go somewhere</a>
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

    include "partials/footer.php";

    ?>