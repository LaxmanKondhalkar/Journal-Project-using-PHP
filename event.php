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

<section id="create-post" class="my-4 p-4">
    <div class="container c-p-container">
        <div class="create-post-container p-4 d-flex align-items-center justify-content-between">
            <div class="profile-icon-container">
                <?php
                $selectUserImg = "SELECT userImage FROM user WHERE user_id = $uId";
                $fireQuery = mysqli_query($conn, $selectUserImg);
                foreach ($fireQuery as $userImage) {
                ?>
                    <img src="userProfiles/<?php echo $userImage['userImage']; ?>" class="profile-icon rounded-circle img-fluid" alt="icon">
                <?php
                }
                ?>
            </div>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add an Event
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Event details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <input type="text" name="eName" class="form-control" placeholder="Event Name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="eLocation" class="form-control" placeholder="Event Location" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="eType" class="form-control" placeholder="Event Type" required>
                                </div>
                                <div class="mb-3">
                                    <input type="date" name="eDate" class="form-control" placeholder="Event Date" required>
                                </div>
                                <div class="mb-3">
                                    <input type="time" name="eTime" class="form-control" placeholder="Event Time" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="eRequirements" class="form-control" placeholder="Event Requirements" required>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="eDesc" placeholder="Event Description" rows="4" required></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="eSubmit" class="btn btn-primary">Post</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['eSubmit'])) {
                                $eName = $_POST['eName'];
                                $eLocation = $_POST['eLocation'];
                                $eType = $_POST['eType'];
                                $eDate = $_POST['eDate'];
                                $eTime = $_POST['eTime'];
                                $eRequirements = $_POST['eRequirements'];
                                $eDesc = $_POST['eDesc'];

                                $InsertQuery = "INSERT INTO `events` (`e_name`, `e_location`, `e_type`, `e_date`, `e_time`, `e_requirements`, `e_desc`, `user_id`) VALUES ('$eName', '$eLocation', '$eType', '$eDate', '$eTime', '$eRequirements', '$eDesc', '$uId')";
                                $result = mysqli_query($conn, $InsertQuery);
                                if ($result > 0) {
                                    echo "<script>window.location.assign('event.php?success');</script>";
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

<?php
if (isset($_GET['success'])) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Event posted successfully. Admin will verify and approve it soon.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<?php
$q = "SELECT * FROM events WHERE status = 'approved' ORDER BY date DESC";
$result = mysqli_query($conn, $q);

foreach ($result as $event) {
?>

    <section id="Posts">
        <div class="container my-5">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <div class="user-data d-flex align-items-center">
                        <?php
                        $uId = $event['user_id'];
                        $query = "SELECT UserFName, userLName, userImage FROM `user` WHERE user_id = $uId";
                        $exec = mysqli_query($conn, $query);

                        foreach ($exec as $value) {
                        ?>
                            <div class="profile-icon-container">
                                <img src="userProfiles/<?php echo $value['userImage']; ?>" class="profile-icon rounded-circle img-fluid" alt="icon">
                            </div>
                            <div class="user-name-j-post ms-3">
                                <p class="user-name fw-semibold">
                                    <?php
                                    echo $value['UserFName'] . " " . $value['userLName'];
                                    ?>
                                </p>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="event-details">
                        <h5 class="card-title"><?php echo $event['e_name'] ?></h5>
                        <hr>
                        <p class="card-text"><span class="event-description">Event Date:</span> <?php echo $event['e_date'] ?></p>
                        <hr>
                        <p class="card-text"><span class="event-description">Event Timing:</span> <?php echo $event['e_time'] ?></p>
                        <hr>
                        <p class="card-text"><span class="event-description">Event Location:</span> <?php echo $event['e_location'] ?></p>
                        <hr>
                        <p class="card-text"><span class="event-description">Event Type:</span> <?php echo $event['e_type'] ?></p>
                        <hr>
                        <p class="card-text"><span class="event-description">Event Requirements:</span> <?php echo $event['e_requirements'] ?></p>
                        <hr>
                        <p class="card-text"><?php echo $event['e_desc'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
}
require('./partials/footer.php');
?>
