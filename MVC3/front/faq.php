<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>FAQ</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/faq.css">
        
    </head>
    
    <body>
       
        <!--Header-->
        <header>
            
            <nav class="navbar navbar-fixed-top">
               <div class="container-fluid">
                   <div class="site-nav-wrapper">

                    <div class="navbar-header">

                        <!--logo-->
                        <a href="main.php" class="navbar-brand smooth-scroll">
                            <img src="images/Front_images/images/logo.png" alt="logo">
                        </a>
                    </div>

                    <!--main menu-->
                    <div class="container">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav pull-right">
                                <li><a class="smooth-scroll" href="noteslisting.php">Search Notes</a></li>
                                <?php
                                    if($_SESSION==null){
                                       echo "<li><a class='smooth-scroll' href='login.php'><button id=loginbtn>Sell Your Notes</button></a></li>"; 
                                    }else{
                                        echo "<li><a class='smooth-scroll' href='dashboard.php'>Sell Your Notes</button></a></li>"; 
                                    }
                                ?>
                                <li><a class="smooth-scroll" href="faq.php">FAQ</a></li>
                                <li><a class="smooth-scroll" href="contact.php">Contact Us</a></li>
                                <?php
                                    if($_SESSION==null){
                                       echo "<li><a class='smooth-scroll' href='login.php'><button id=loginbtn>Login</button></a></li>"; 
                                    }else{
                                         
                                        $userid= $_SESSION['id'];
                                        $query="SELECT * From userprofile WHERE userid='$userid'";
                                        $result=mysqli_query($connection,$query);
                                        if($row=mysqli_fetch_assoc($result)){
                                            $profilepicture=$row['profilepic'];
                                        }
                                        echo "<li>";
                                        echo "<div class='dropdown'>";
                                        echo "<input type='image' style='border-radius:50%;' src='../uploaded/$profilepicture' class='smooth-scroll dropbtn img-responsive' onclick='myFunction()'>";
                                        echo "<div id='myDropdown' class='dropdown-content'>";
                                        echo "<a href='userprofile.php'>Update Profile</a>";
                                        echo "<a href='mydownloads.php'>My Downloads</a>";
                                        echo "<a href='mysoldnotes.php'>My Sold Notes</a>";
                                        echo "<a href='myrejectednotes.php'>My Rejected Notes</a>";
                                        echo "<a href='cpass.php'>Change Password</a>";
                                        echo "<a href='login.php'>Logout</a>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</li>";
                                        echo "<li><a class='smooth-scroll' href='logout.php'><button onclick='return confirm('Are you sure, you want to logout?');' id=logoutbtn>Logout</button></a></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!--main menu end-->
                </div>
               </div>
                
            </nav>
            
        </header>
        <!--Header End-->
        
    <!-- FAQ Section -->
    <section id="faq">
        <div class="faq-heading">
            <p>Frequently Asked Questions</p>
        </div>
        <div class="faq-sub">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="faq-sub-heading">General Question</p>
                    </div>
                    <div class="col-md-12">
                        <button class="accordion">What is Marketplace Notes?</button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labori.</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="accordion">What do the University say?</button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labori.</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="accordion">Is this legal?</button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labori.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="faq-sub">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="faq-sub-heading">Uploaders</p>
                    </div>
                    <div class="col-md-12">
                        <button class="accordion">What can't I sell?</button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labori.</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="accordion">What notes can I sell?</button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labori.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="faq-sub">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="faq-sub-heading">Downloaders</p>
                    </div>
                    <div class="col-md-12">
                        <button class="accordion">How do I buy notes?</button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labori.</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="accordion">Can I edit the notes I purchased?</button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labori</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ Section Ends -->
        
        <footer>
            <!--Footer-->
            <div class="content-box-lg">

                <div class="contanier">

                    <div class="row">

                        <div class="col-md-6" id="copytext">
                            <h5>Copyright @ TatvaSoft. All rights reserved.</h5>
                        </div>

                        <div class="col-md-6">
                            <ul class="social-list text-right">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>
            
        </footer>
        <!--Footer End-->
        
    </body>
    
    <!--Jquery-->
    <script src="js/jquery.js"></script>

    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!--Owl carousel-->
    <script src="js/owl-carousel/owl.carousel.min.js"></script>

    <!--custom JS-->
    <script src="js/faq.js"></script>

</html>