<!--<!DOCTYPE hmtl>
<?php /*include "../includes/db.php";*/ ?>
<?php /*session_start();*/ ?>
<html lang="en">
    <head>
       
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Add Category</title>
        
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <link rel="stylesheet" href="css/addcat.css">
        
    </head>
    
    <body>
        
        <header>
            
            <nav class="navbar navbar-fixed-top">
               <div class="container-fluid">
                   <div class="site-nav-wrapper">

                        <div class="navbar-header">

                            <a href="main.html" class="navbar-brand smooth-scroll">
                                <img src="images/Admin_images/images/logo.png" alt="logo">
                            </a>
                        </div>

                        <div class="container">
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav pull-right">
                                    <li><a class="smooth-scroll" href="dashboard.html">Dashboard</a></li>
                                    <li><a class="smooth-scroll" href="noteview.html"> Notes</a></li>
                                    <li><a class="smooth-scroll" href="buyerreq.html">Members</a></li>
                                    <li><a class="smooth-scroll" href="faq.html">Reports</a></li>
                                    <li><a class="smooth-scroll" href="contact.html">Settings</a></li>
                                    <li>
                                        <div class="dropdown">
                                        <?php 
                                            /*$userid= $_SESSION['id'];
                                            $query="SELECT * From userprofile WHERE userid='$userid'";
                                            $result=mysqli_query($connection,$query);
                                            if($row=mysqli_fetch_assoc($result)){
                                                $profilepicture=$row['profilepic'];
                                            }*/
                                        ?>
                                        <input type="image" style="border-radius:50%;height:50px;width:50px;" src="../uploaded/<?php echo $profilepicture; ?>" class="smooth-scroll dropbtn img-responsive" onclick="myFunction()">
                                            <div id="myDropdown" class="dropdown-content">
                                                <a href="myprofile.php">Update Profile</a>
                                                <a href="../front/cpass.php">Change Password</a>
                                                <a href="../front/logout.php" style="color:#6255a5;text-transform:uppercase;">Logout</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="smooth-scroll" href="login.html"><button id=logoutbtn>Logout</button></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
               </div>
                
            </nav>
            
        </header>
        <section id="myprofile">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <h2>Add Category</h2>
                            </div>
                        </div>
        
                    </div>
                    
                    <div class="row">
        
                        <div class="col-md-6">
                            <form>
                                <label for="category">Category Name &#42;</label><br>
                                <input type="varchar" id="category" name="category" placeholder="Enter your category">
                                
                                <label for="des">Description &#42;</label><br>
                                <textarea id="des" for="des" placeholder="Enter your description"></textarea>
                                
                                <button id="submitbtn" type="button">Submit</button>
                                
                            </form>
                        </div>
                        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        
        <footer>
            <div class="content-box-sm">

                <div class="contanier">

                    <div class="row">

                        <div class="col-md-6 text-left">
                            <h5>Version: 1.1.24</h5>
                        </div>

                        <div class="col-md-6 text-right" id="copytext">
                            <h5>Copyright @ TatvaSoft. All rights reserved.</h5>
                        </div>

                    </div>

                </div>

            </div>
            
        </footer>
        
    </body>
</html>-->