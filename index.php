<?php
$page = "index.php";
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: login.php", true);
    exit();
}
$uId = $_SESSION['userId'];

require('./partials/header.php');
require "config.php";
?>

<!-- Content Section -->
<?php
if (isset($_GET['msg'])) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Post Added Successfully.</strong>
        Admin will review and approve the post soon enough.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

<section id="create-post" class="my-4 p-4">
    <div class="container c-p-container">
        <div class="create-post-container p-4 d-flex">
            <div class="profile-icon-container offset-md-1">
                <?php
                $selectUserImg = "SELECT userImage FROM user WHERE user_id = $uId";
                $fireQuery = mysqli_query($conn, $selectUserImg);
                foreach ($fireQuery as $userImage) {
                ?>
                    <img src="./userProfiles/<?php echo $userImage['userImage']; ?>" class="profile-icon rounded-circle img-fluid" alt="icon">
                <?php
                }
                ?>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn col-8 col-md-8 ms-5 text-center share-post-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Write a journal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Write Journal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <input type="text" name="journalTitle" spellcheck="false" class="form-control" id="exampleInputText" placeholder="Journal Title">
                                </div>

                                <!-- Dropdown -->
                                <div class="mb-3">
                                    <select name="category" class="form-select" id="category">
                                        <option selected disabled>Select a category for your Post</option>
                                        <option value="journal">Journal</option>
                                        <option value="blog">Blog</option>
                                        <option value="article">Article</option>
                                        <option value="memoir">Memoir</option>
                                        <option value="record">Record</option>
                                    </select>
                                </div>

                                <!-- Text Area -->
                                <div class="mb-3">
                                    <textarea class="form-control" spellcheck="false" name="journalDescription" id="message-text" placeholder="Write journal here..." style="height:200px;"></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="journalSubmit" class="btn btn-primary">Post</button>
                                </div>
                            </form>

                            <?php
                            $title = mysqli_real_escape_string($conn, (isset($_POST['journalTitle']) ? $_POST['journalTitle'] : ""));
                            $description = mysqli_real_escape_string($conn, (isset($_POST['journalDescription']) ? $_POST['journalDescription'] : ""));
                            $category = (isset($_POST['category']) ? $_POST['category'] : "journal");
                            $status = "pending";

                            if (isset($_POST['journalSubmit'])) {
                                $q = "INSERT INTO `journals` (`title`, `description`, `status`, `user_id`, `category`) VALUES ('$title', '$description', '$status', '$uId', '$category')";
                                $result = mysqli_query($conn, $q);

                                if ($result > 0) {
                                    echo "<script>window.location.assign('index.php?msg');</script>";
                                } else {
                                    echo "Insertion failed <br>";
                                    echo mysqli_error($conn);
                                    echo "<br>";
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
$q = "SELECT * FROM journals WHERE status = 'approved' ORDER BY date DESC";
$result = mysqli_query($conn, $q);

foreach ($result as $journal) {
?>
    <section id="Posts">
        <div class="container my-5">
            <div class="row">
                <div class="card post-card">
                    <div class="card-header d-flex">
                        <div class="user-data d-flex">
                            <?php
                            $uId = $journal['user_id'];
                            $query = "SELECT UserFName, userLName, userImage FROM `user` WHERE user_id = $uId";
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
                                        ?>
                                    </p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title"><?php echo $journal['title']; ?></h5>
                        <p class="card-text">
                            <?php
                            echo substr($journal['description'], 0, 600) . " ";
                            if (strlen($journal['description']) > 600) {
                            ?>
                                <a href="singleJournal.php?id=<?php echo $journal['journal_id']; ?>" class="text-decoration-none">read more....</a>
                            <?php
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}
?>

<?php
require('./partials/footer.php');
?>
