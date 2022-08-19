<?php
$page = "diary.php";
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
                <img src="./assets/images/Megumi Fushiguro.jpg" class="profile-icon" alt="icon">
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn col-8 col-md-8 ms-5 text-center share-post-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Write Today's Diary.
            </button>

            <!-- Modal -->
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
                                    <input type="text" name="journalTitle" class="form-control" id="exampleInputText" placeholder="Journal Title">
                                </div>
                                <div class="mb-3">
                                    <!-- <label for="message-text" class="col-form-label">Message:</label> -->
                                    <textarea class="form-control" name="journalDescription" id="message-text" placeholder="Write journal here..."></textarea>
                                </div>

                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary">Add images</button> -->
                                    <button type="submit" name="journalSubmit" class="btn btn-primary">Post</button>
                                </div>
                            </form>
                            <?php
                                $date = date("y-m-d");
                                $title = (isset($_POST['journalTitle']) ? $_POST['journalTitle'] : "");
                                $description = (isset($_POST['journalDescription']) ? $_POST['journalDescription'] : "");
                                $status = "pending";
                                $uId = $_GET['userId'];

                                if (isset($_POST['journalSubmit'])) {
                                    require "config.php";
                                    $q = "Insert into `journals` (`date`,`title`,`description`, `status`, `user_id`) values ('$date','$title','$description', '$status', '$uId')";

                                    $result = mysqli_query($conn, $q);
                                    
                                    if ($result > 0) {
                                        echo "Journal Posted Successfully";
                                        echo "<script> windows.location.reload(); </script>"; 
                                    } else {
                                        echo "insertion failed <br>";
                                        echo mysqli_error($conn); 
                                        echo "<br>"; 
                                        print_r($result); 
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
<section id="journal-posts" class="my-4 p-4">
    <div class="container j-container ">
        <div class="j-post p-4 ">
            <!-- Journal Post header section -->
            <div class="j-post-header d-flex offset-lg-1">
                <!-- user image and name -->
                <div class="user-data d-flex justify-content-end me-5">
                   <h3>1/11/11</h3>
                </div>
                <!-- date of journal and options btn  -->
                <div class="j-date-and-options d-flex col-sm-9 col-md-10 justify-content-end">
                    <!-- <div class="date d-flex  me-5">
                                <p class="pt-2">1/1/11</p>
                            </div> -->
                    <div class="options btn">
                        <span class="dots"></span>
                        <span class="dots"></span>
                        <span class="dots"></span>
                    </div>
                </div>
            </div>
            <!-- Journal title and content. -->
            <div class="journal-title-and-content col-lg-10 offset-lg-1 mt-4">
                <div class="journal-title">
                    <h5>This will be title of the Diary</h5>
                </div>
                <div class="journal-content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nisi ut dolore totam modi fugiat repellat temporibus ex itaque necessitatibus maxime impedit amet delectus atque voluptatum non, debitis facere! Culpa, at incidunt! Dicta? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni vero architecto illum laudantium veritatis officiis doloremque ipsa praesentium esse! Fuga?</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require('./partials/footer.php');
?>