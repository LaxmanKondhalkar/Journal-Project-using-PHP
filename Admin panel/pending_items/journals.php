<?php
$page = "journals.php";
include "../assets/header.php";
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
                            <div class="profile-icon-container">
                                <img src="../../userProfiles/<?php echo $value['userImage']; ?>" class="profile-icon img-fluid" alt="icon">
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
                <form class="j-like-section offset-lg-1 mt-5 row" action="" method="POST">
                    <div class="d-flex align-items-center col-sm-6  px-0">
                        <button name="<?php echo "approve".$journal['journal_id'];?>" type="submit" class="btn btn-primary">Approve</button>
                    </div>
                    <div class="reject-btn d-flex justify-content-center col-sm-6  px-0">
                        <button name="<?php echo "reject".$journal['journal_id'];?>" type="submit" class="btn btn-primary">Reject</button>
                    </div>
                </form>
                <?php 
                    if(isset($_POST["approve".$journal['journal_id']])){
                        $jId = $journal['journal_id']; 
                        $updateQuery = "UPDATE journals SET status='approved' WHERE journal_id='$jId'"; 
                        $fireUpdateQuery = mysqli_query($conn, $updateQuery); 
                        if($fireUpdateQuery > 0){
                            echo "Journal Approved";
                        }else{
                            echo "booo!! Error".mysqli_error($conn); 
                        }
                    }
                    else if(isset($_POST["reject".$journal['journal_id']])){
                        $jId = $journal['journal_id']; 
                        $deleteQuery = "DELETE FROM journals WHERE journal_id='$jId'"; 
                        $fireDeleteQuery = mysqli_query($conn, $deleteQuery); 
                        if($fireDeleteQuery > 0){
                            echo "Journal deleted";
                            echo "<script> windows.location.reload(); </script>"; 
                        }else{
                            echo "booo!! Error".mysqli_error($conn); 
                        }                   
                    }
                ?>
            </div>
        </div>
    </section>
<?php
}
?>