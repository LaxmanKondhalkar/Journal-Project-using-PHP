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
                <div class="col-lg-4" >
                    <div class="card mb-4 style="height : 400px"">
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

                                                if(isset($_POST['addImg'])){
                                                    $pic = $_FILES['userImg']['name']; 
                                                    $newName = $pic.$uId;
                                                    $location = $_FILES['userImg']['tmp_name'];
                                                    $updateQuery = "UPDATE user SET userImage='$newName' where user_id= $uId";
                                                    $exec = mysqli_query($conn, $updateQuery);
                                                    if($exec > 0){
                                                        move_uploaded_file($location,'userProfiles/'.$newName);
                                                    }
                                                    else{
                                                        echo "Error".mysqli_error($conn);
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
                                    <p class="text-muted mb-0"><?php echo $user['userGender'];} ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User's Journal and Diary.. -->
                <div class="row" style="height : 1000px;">
                    <iframe src="iframe_pages/user_journal.php" frameborder="0">

                    </iframe>
                </div>


                <form class="row  d-flex justify-content-center align-center mt-5" action="" method="GET">
                    <button class="btn btn-primary logout-btn  col-md-6" name="logout" type="submit">Logout</button>
                </form>
                <?php
                    if (isset($_GET['logout'])) {
                        session_unset();
                        session_destroy();
                        echo "<script> window.location.assign('login.php');</script>";
                    }
                ?>
            </div>
    </section>



    <?php

    include "partials/footer.php";

    ?>