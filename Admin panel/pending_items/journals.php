<?php 
    $page = "journals.php"; 
    include "../assets/header.php"; 
?>

<?php
require '../../config.php';

$q = "select * from journals where status= 'pending'";

$result = mysqli_query($conn, $q);

foreach ($result as $journal) {
?>
    <section id="journal-posts" class="my-4 p-4">
        <div class="container j-container ">
            <div class="j-post p-4 ">
                <!-- Journal Post header section -->
                <div class="j-post-header d-flex offset-lg-1">
                    <!-- user image and name -->
                    <div class="user-data d-flex justify-content-end me-5">
                        <?php
                            $uId = $journal['user_id'];
                            $query = "select UserFName,userLName,userImage from `user` WHERE user_id= $uId";
                            $exec = mysqli_query($conn, $query);

                            foreach ($exec as $value) {
                               
                        ?>
                        <div class="profile-img-under-post">
                            <img src="../../userProfiles/<?php echo $value['userImage']; ?>" class="profile-icon" alt="icon">
                        </div>
                        <div class="user-name-j-post">
                            <p class="pt-2 ps-3 userName">
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
                    <div class="journal-title">
                        <h5><?php echo $journal['title']; ?></h5>
                    </div>
                    <div class="journal-content">
                        <p><?php echo $journal['description']; ?></p>
                    </div>
                </div>
                <div class="j-like-section offset-lg-1 mt-4 ">
                    <div class="btn j-like-btn d-flex align-items-center col-md-1 px-0">
                        <img src="../../assets/images/heart-solid.svg" class="j-like-btn-img" alt="like">
                        <p class="ms-2">Like</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}
?>