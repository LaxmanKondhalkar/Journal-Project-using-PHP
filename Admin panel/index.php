<?php
$page = "index.php";


session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: login.php", true);
    exit();
}
$adminId = $_SESSION['adminId'];


include 'assets/header.php';
require "../config.php"; 
?>


<!-- <section id="title">
       title section
      
     <div class="container">
      <div class="title-container col-xs-5 offset-xs-4 col-lg-7 offset-lg-2 col-xl-7 offset-xl-4 pt-2">
        <h1>Admin Panel</h1>
        <p>Admin has the authority of approving pending journals, events , questions and answers. Admin can also see the growth of users in the website. </p>
    </div>
     </div>
    </section> -->

<section id="main" class="my-5">
  <div class="container">
    <div class="row d-flex justify-content-center ">
      <div class="col-xs-12 col-md-4 mx-3 my-2">
        <div class="card">
          <div class="card-body text-center item-bg">
            <?php 
              $query = "select COUNT(*) from journals where status='pending'"; 
              $fireQuery = mysqli_query($conn, $query);
              foreach($fireQuery as $value){
                // print_r($value); 
            ?>
            <h3 class="card-title">
                <?php 
                  echo $value['COUNT(*)']; 
              }
                ?>
            </h3>
            <p class="card-text">Pending Journals</p>
            <a href="journals.php" class="btn btn-primary go-to-item-btn">Go to Item</a>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-4 mx-3 my-2">
        <div class="card">
        <div class="card-body text-center item-bg">
            <?php 
              $query = "select COUNT(*) from events where status='pending'"; 
              $fireQuery = mysqli_query($conn, $query);
              foreach($fireQuery as $value){
                // print_r($value); 
            ?>
            <h3 class="card-title">
                <?php 
                  echo $value['COUNT(*)']; 
              }
                ?>
            </h3>
            <p class="card-text">Pending Events</p>
            <a href="events.php" class="btn btn-primary go-to-item-btn">Go to Item</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Second Row -->
    <!-- <div class="row mt-5 d-flex justify-content-center ">
      <div class="col-xs-12 col-md-4 mx-3 my-2">
        <div class="card">
          <div class="card-body text-center item-bg">
            <h4 class="card-title">4</h4>
            <p class="card-text">Pending Answers</p>
            <a href="Answers.php" class="btn btn-primary go-to-item-btn">Go to Diaries</a>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-4 mx-3 my-2">
        <div class="card">
          <div class="card-body text-center item-bg">
            <h4 class="card-title">10</h4>
            <p class="card-text">Pending questions</p>
            <a href="questions.php" class="btn btn-primary go-to-item-btn">Go to Questions</a>
          </div>
        </div>
      </div>
    </div> -->
  
</section>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>