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
                        <img src="./images/Megumi Fushiguro.jpg" class="profile-icon" alt="icon">
                    </div>
                    <div class="btn col-8 col-md-8 ms-5 text-center share-post-btn">
                        <p class="pt-1">Write a Journal</p>
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
                            <div class="profile-img-under-post">
                                <img src="./images/Megumi Fushiguro.jpg" class="profile-icon" alt="icon">
                            </div>
                            <div class="user-name-j-post">
                                <p class="pt-2 ps-3 userName">@megumi-Fushiguro</p>
                            </div>
                        </div>
                        <!-- date of journal and options btn  -->
                        <div class="j-date-and-options d-flex col-sm-5 col-md-7 justify-content-end">
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
                            <h5>This will be title of the journal</h5>
                        </div>
                        <div class="journal-content">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nisi ut dolore totam modi fugiat repellat temporibus ex itaque necessitatibus maxime impedit amet delectus atque voluptatum non, debitis facere! Culpa, at incidunt! Dicta? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni vero architecto illum laudantium veritatis officiis doloremque ipsa praesentium esse! Fuga?</p>
                        </div>
                    </div>
                    <div class="j-like-section offset-lg-1 mt-4 ">
                        <div class="btn j-like-btn d-flex align-items-center col-md-1 px-0">
                            <img src="./images/heart-solid.svg" class="j-like-btn-img" alt="like">
                            <p class="ms-2">Like</p>
                            
                        </div>  
                    </div>
                </div>
               
            </div>
        </section>
        <?php 
        require('./partials/footer.php');
    ?>