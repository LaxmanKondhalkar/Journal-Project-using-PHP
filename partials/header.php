<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
        <style>
            <?php 
                include "assets/css/style.css";
                include "assets/css/utils.css";
            ?>
        </style>
    </head>

    <body>
        <!-- ============!!!!! Header !!!!!!============== -->
        <header>

            <nav class="navbar navbar-expand-lg  pt-2">
                <div class="container">

                    <div class="col-md-4 col-lg-2 col-xl-4 d-flex justify-content-start align-items-center">

                        <a class="navbar-brand online-journal-txt text-wrap online-journal-txt" href="#">
                            <h2>Online Journal</h2>
                        </a>

                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse  col-md-7 " id="myNavbar">

                        <ul class="navbar-nav nav-bg">          
                            <li class="nav-item ">
                                <a class="nav-link  px-4 fs-5 nav-anchor <?php echo ($page == "journals.php" ? "active-nav-link" : "" )?> " 
                                    href="http://localhost/Journal-Project-using-PHP/journal.php">Journals</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link px-4 fs-5 nav-anchor <?php echo ($page == "diary.php" ? "active-nav-link" : "" )?>" 
                                href="http://localhost/Journal-Project-using-PHP/diary.php">Diary</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link px-4  fs-5 nav-anchor <?php echo ($page == 'event.php' ? "active-nav-link" :"" )?>" 
                                href="http://localhost/Journal-Project-using-PHP/event.php">Events</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link px-4 fs-5 nav-anchor <?php echo ($page == "QandA.php"? "active-nav-link": "")?> "
                                href="http://localhost/Journal-Project-using-PHP/QandA.php">Q&A</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link px-4 fs-5 nav-anchor <?php echo ($page == "profile.php" ? "active-nav-link" :"" )?> "
                                href="http://localhost/Journal-Project-using-PHP/profile.php">Profile</a>
                            </li>
                        </ul>

                    </div>

                </div>
            </nav>

        </header>