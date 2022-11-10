<?php
require('../config.php');
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $q = "select * from `admin`";
    $result = mysqli_query($conn, $q);

    foreach ($result as $admin) {

        if ($email == $admin['email'] && $pass == $admin['pass']) {
            $adminLoggedIn = true;
            $adminId = $admin['id'];
            session_start(); 
            
            $_SESSION['adminLoggedIn'] = true; 
            $_SESSION['adminId'] = $adminId;  
            echo "<script> window.location.assign('index.php');</script>";
        } else {
            echo "email or password is wrong try again";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        .main-container {
            margin: 0 !important;
            padding: 0 !important;
        }
    </style>
</head>

<body>

    <div class="container-fluid main-container">

        <!-- Section: Design Block -->
        <section class="text-center mb-5">
            <!-- Background image -->
            <div class="p-5 bg-image" style="
          background : #534A4A; 
          height: 250px;
          "></div>
            <!-- Background image -->
            <!-- background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg'); -->

            <div class="card mx-4 mx-md-5 shadow-5-strong" style="
                      margin-top: -100px;
                      background : #d9d9d9;
                      backdrop-filter: blur(30px);
                      ">
                      <!-- background: hsla(0, 0%, 100%, 0.8); -->

                <div class="card-body py-5 px-md-5">

                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-5">Sign in</h2>
                            <form action="" method="post">
                                <!-- 2 column grid layout with text inputs for the first and last names -->

                                <!-- Email input -->

                                <div class=" mb-4">
                                    <label class="form-label " for="form3Example3">Email address</label>
                                    <input type="email" id="form3Example3" name="email" class="form-control" />
                                </div>

                                <!-- Password input -->
                                <div class=" mb-4">
                                    <label class="form-label " for="form3Example4">Password</label>
                                    <input type="password" id="form3Example4" name="pass" class="form-control" />
                                </div>


                                <!-- Submit button -->
                                <div class="row d-flex justify-content-center">
                                    <button type="submit" name="submit" class="btn btn-primary  mb-4 col-md-4">
                                        Sign in
                                    </button>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Design Block -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>