<?php
    require "config.php";
    $page = "diary.php";
    session_start();

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
        header("location: login.php", true);
        exit();
    }
    
    require('./partials/header.php');
?>
<?php
    $dId = $_GET['id']; 
  
    $query = "select * from diary where diary_id=$dId";
    $result = mysqli_query($conn, $query);
    foreach ($result as $diary) {
?>

<section id="Posts ">
        <div class="container my-5">
            <div class="row">
                <div class="card post-card">
                    <div class="card-header d-flex">
                        <h3><?php echo date('j F Y, l', strtotime($diary['date'])); ?> </h3>

                        <div class="dropdown dropstart options post-options">
                            <button class="btn rotate90 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="dots"></span>
                                <span class="dots"></span>
                                <span class="dots"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <form action="updateDiary.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $diary['diary_id']; ?>">
                                        <input class="dropdown-item btn" name="EditDiary" type="submit" value="Edit">
                                    </form>

                                </li>
                                <li>
                                    <form action="diary.php" method="POST">
                                        <input type="hidden" name="diaryId" value="<?php echo $diary['diary_id']; ?>">
                                        <input class="dropdown-item btn" name="deleteDiary" type="submit" value="Delete">
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $diary['title'];  ?></h5><br>
                        <p class="card-text"><?php echo $diary['description']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php
    }

    require('./partials/footer.php');
?>