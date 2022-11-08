<?php
require "config.php";
$page = "journal.php";
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: login.php", true);
    exit();
}

require('./partials/header.php');
?>
<?php
$jId = $_GET['id'];

$query = "select * from journals where journal_id=$jId";
$result = mysqli_query($conn, $query);
foreach ($result as $journal) {
?>

    <section id="Posts ">
        <div class="container my-5">
            <div class="row">
                <div class="card post-card">
                    <div class="card-header d-flex">
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

                    </div>

                    <div class="dropdown dropstart options post-options">
                        <button class="btn rotate90 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="dots"></span>
                            <span class="dots"></span>
                            <span class="dots"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <form action="updateDiary.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $journal['journal_id']; ?>">
                                    <input class="dropdown-item btn" name="EditDiary" type="submit" value="Edit">
                                </form>

                            </li>
                            <li>
                                <form action="diary.php" method="POST">
                                    <input type="hidden" name="diaryId" value="<?php echo $journal['journal_id']; ?>">
                                    <input class="dropdown-item btn" name="deleteDiary" type="submit" value="Delete">
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h5 class="card-title"><?php echo $journal['title'];  ?></h5><br>
                    <p class="card-text"><?php echo $journal['description']; ?></p>
                </div>
            </div>
        </div>
        </div>
    </section>



<?php
}

require('./partials/footer.php');
?>