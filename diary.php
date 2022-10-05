<?php
    require "config.php";
    $page = "diary.php";
    session_start();

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
        header("location: login.php", true);
        exit();
    }
    $uId = $_SESSION['userId'];
    $_SESSION['currDate'] = date('Y-m-d'); 
    $dateExist = false;

    $checkDate = "Select DATE_FORMAT(date, '%Y-%m-%d') DATEONLY from diary where user_id = $uId";
    $dates = mysqli_query($conn, $checkDate);

    // echo $_SESSION['currDate']; 
    foreach ($dates as $date) {
        if ($date['DATEONLY'] == $_SESSION['currDate']) {
            // echo "Date exist show the diary content and append the new ones if there.";
            $dateExist = true; 
        }
        else{
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
                                require "config.php";
                                $q = "Insert into `diary` (`title`,`description`, `user_id`) values ('$title','$description', '$uId')";

                                $result = mysqli_query($conn, $q);

                                if ($result > 0) {
                                    echo "Diary Added Successfully";
                                    echo "<script> windows.location.reload(); </script>";
                                } else {
                                    echo "insertion failed <br>";
                                    echo mysqli_error($conn);
                                    echo "<br>";
                                    print_r($result);
                                }
                            }
                            else{
                                echo "<script>alert('Insertion failed.');</script>"; 
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
require "config.php";

$query = "select * from diary where user_id=$uId order by date desc";
$result = mysqli_query($conn, $query);
foreach ($result as $diary) {
?>
    <!-- Posts Section -->
    <section id="journal-posts" class="my-4 p-4">
        <div class="container j-container ">
            <div class="j-post p-4 ">
                <!-- Journal Post header section -->
                <div class="j-post-header d-flex offset-lg-1">
                    <!-- user image and name -->
                    <div class="user-data d-flex justify-content-end me-5">
                        <h3><?php echo $diary['date']; ?></h3>
                    </div>
                    <!-- date of journal and options btn  -->
                    <!-- <div class="j-date-and-options d-flex col-sm-9 col-md-9 justify-content-end dropstart">
                        <div class="options btn " data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="dots"></span>
                            <span class="dots"></span>
                            <span class="dots"></span>
                        </div> 
                        <form class=" dropdown-menu text-center" method="POST">
                            <li class="mb-2"><button type="submit" name="edit" class="btn btn-light w-100">Edit</button></li>
                            <li class="mb-2"><button type="submit" name="delete" class="btn btn-light w-100">Delete</button></li>
                        </form>
                       
                    </div> -->
                </div>
                <!-- Journal title and content. -->
                <div class="journal-title-and-content col-lg-10 offset-lg-1 mt-4">
                    <div class="journal-title">
                        <h5><?php echo $diary['title'];  ?></h5>
                    </div>
                    <div class="journal-content">
                        <p><?php echo $diary['description']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
}
require('./partials/footer.php');
?>