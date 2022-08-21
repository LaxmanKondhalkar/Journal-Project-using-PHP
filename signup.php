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
                            <h2 class="fw-bold mb-5">Sign up now</h2>


                            <form action="" method="POST" enctype="multipart/form-data">
                                <!-- 2 column grid layout with text inputs for the first and last names -->

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example1" pattern="[A-Za-z ]{1,}">First name</label>
                                            <input type="text" id="form3Example1" name="userFName" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example2" pattern="[A-Za-z ]{1,}">Last name</label>
                                            <input type="text" id="form3Example2" name="userLName" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example3">Phone</label>
                                            <input type="phone" id="form3Example3" name="userPhone" class="form-control" pattern="[7-9]{1}[0-9]{9}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <label for="gender" class="form-label">Gender</label>
                                        <div class="radioButtons">
                                            <input class="form-check-input" type="radio" name="userGender" value="male" id="flexRadioDefault1">
                                            <label class="form-check-label me-2" for="flexRadioDefault1">
                                                Male
                                            </label>

                                            <input class="form-check-input" type="radio" name="userGender" value="female" id="flexRadioDefault1">
                                            <label class="form-check-label me-2" for="flexRadioDefault1">
                                                Female
                                            </label>

                                            <input class="form-check-input" type="radio" name="userGender" value= "other" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email input -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" for="form3Example3">Email address</label>
                                        <input type="email" id="form3Example3" name="userEmail" class="form-control" />
                                    </div>

                                    <!-- Password input -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" for="form3Example4">Password</label>
                                        <input type="password" id="form3Example4" name="userPass" class="form-control" />
                                    </div>
                                </div>
                                <!-- First acquiring the user id would be better since there are chance of image duplicacy if we name the image along with the user id it will prevent that from happening. -->
                                <!-- <div class="row">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Add image</label>
                                        <input class="form-control" name="userImg" type="file" id="formFile">
                                    </div>
                                </div> -->

                                <!-- Submit button -->
                                <div class="row d-flex justify-content-around">
                                    <button type="submit" class="btn btn-primary  mb-4 col-md-4" name="submit">
                                        Sign up
                                    </button>
                                    <div class="signup-text  mb-4 col-md-4">
                                        <p class="mb-0">Already have an Account?</p>
                                        <a href="login.php">Sign in</a>
                                        
                                    </div>
                                </div>
                            </form>

                            <?php
                            require('config.php');
                            $tableName = "user";
                            if (isset($_POST['submit'])) {

                                $userFName = $_POST['userFName'];
                                $userLName = $_POST['userLName'];
                                $userEmail = $_POST['userEmail'];
                                $userPass = $_POST['userPass'];
                                $userPhone = $_POST['userPhone'];
                                $userGender = $_POST['userGender'];
                                $userStatus = 'unblocked';
                                $userImage = "user.png";


                                $q = "Insert into `user` (`UserFName`,`userLName`,`userEmail`, `userPass`, `userPhone`, `userGender`, `userStatus`, `userImage`) values ('$userFName','$userLName','$userEmail', '$userPass', '$userPhone' , '$userGender' ,'$userStatus' ,'$userImage')";

                                // $conn = exec($q);
                                $result = mysqli_query($conn, $q); 
                             
                                if ($result > 0) {
                                    echo "<script> windows.location.assign(login.php);</script> ";
                                } else {
                                    echo "insertion failed";
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
        </section>
        <!-- Section: Design Block -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>