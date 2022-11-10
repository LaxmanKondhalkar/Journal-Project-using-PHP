<?php
    session_start();
    $page = "contactRecords.php";

    if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {

        header("location: login.php", true);
        exit();
    }
    $adminId = $_SESSION['adminId'];
    // echo $_SESSION['adminId'];
    

    include "assets/header.php";
    require '../config.php';

    $q = "SELECT * FROM contact_form ORDER BY DATE DESC";
    $result = mysqli_query($conn, $q);
    foreach ($result as $record) {
?>

    <section id="journal-posts" class="my-4 p-4">
        <div class="container j-container ">
            <div class="j-post p-4 ">
                <!-- Journal Post header section -->
                <div class="j-post-header d-flex offset-lg-1">
                    <!-- user image and name -->
                    <div class="user-data d-flex justify-content-end me-5">

                        <?php
                        $uId = $record['user_id'];
                        $query = "select UserFName,userLName,userImage from `user` WHERE user_id= $uId";
                        $exec = mysqli_query($conn, $query);

                        foreach ($exec as $value) {

                        ?>
                            <div class="profile-icon-container">

                                <img src="../userProfiles/<?php echo $value['userImage']; ?>" class="profile-icon rounded-circle img-fluid" alt="icon">
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
                 
                </div>
                <!-- Journal title and content. -->
                <div class="journal-title-and-content col-lg-10 offset-lg-1 mt-4">
                    <div class="">
                        <h5><?php echo $record['email'] ?></h5>
                    </div>
                    <hr>
                    <div class="">
                        <h6><?php echo $record['subject'] ?></h6>
                    </div>
                    <hr>
                    <div class="">
                        <h6><?php echo $record['message'] ?></h6>
                    </div>
                   

                <form class="j-like-section  mt-5 row" action="" method="POST">
                    <div class="reject-btn col-sm-6  px-0">
                        <button name="<?php echo "read".$record['id'];?>" type="submit" class="btn btn-primary">Mark as Done</button>
                    </div>
                </form>
                <?php 
                    // if(isset($_POST["approve".$event['id']])){
                    //     $eId = $event['id']; 
                    //     $updateQuery = "UPDATE events SET status='approved' WHERE id='$eId'"; 
                    //     $fireUpdateQuery = mysqli_query($conn, $updateQuery); 
                    //     if($fireUpdateQuery > 0){
                    //         echo "Approved";
                    //     }else{
                    //         echo "Error".mysqli_error($conn); 
                    //     }
                    // }
                     if(isset($_POST["read".$record['id']])){
                        $cId = $record['id']; 
                        $deleteQuery = "DELETE FROM contact_form WHERE id='$cId'"; 
                        $fireDeleteQuery = mysqli_query($conn, $deleteQuery); 
                        if($fireDeleteQuery > 0){
                            echo "deleted";
                            echo "<script> window.location.assign('contactRecords.php'); </script>"; 
                        }else{
                            echo "Error".mysqli_error($conn); 
                        }                   
                    }
                ?>
            </div>
        </div>
    </section>


<?php
}
// require('../../partials/footer.php');
?>