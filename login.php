<?php
    require('config.php');
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $q = "select * from `user`";
        $result = mysqli_query($conn, $q);

        foreach ($result as $user) {
            // print_r($user); 
            if ($email == $user['userEmail'] && $pass == $user['userPass']) {
                $uId = $user['user_id'];
                $login = true;
                session_start(); 
                $_SESSION['loggedIn'] = true; 
                $_SESSION['userId'] = $uId; 
                echo "<script> window.location.assign('journal.php');</script>";
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
          background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
          height: 250px;
          "></div>
            <!-- Background image -->

            <div class="card mx-4 mx-md-5 shadow-5-strong" style="
                      margin-top: -100px;
                      background: hsla(0, 0%, 100%, 0.8);
                      backdrop-filter: blur(30px);
                      ">
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
                                <div class="row d-flex justify-content-around">
                                    <button type="submit" class="btn btn-primary mb-4 col-md-4" name="submit">
                                        Sign in
                                    </button>
                                    <div class="signup-text  mb-4 col-md-4">

                                        <p class="mb-0">Don't have an Account?</p>
                                        <a href="">Sign up</a>
                                    </div>
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