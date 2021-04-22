<?php include "../includes/db.php"; ?>
<?php session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>User Profile</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/userprofile.css">
        
    </head>
    
    <?php
        
        $userid=$_SESSION['id'];

        $query="SELECT * from users where id=$userid";
        $result = mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($result)){
            $emailfromtable=$row['emailID'];
        }

    ?>
    
    <body>
        
        <!--Header-->
        <header>
            
            <nav class="navbar navbar-fixed-top">
               <div class="container-fluid">
                   <div class="site-nav-wrapper">

                        <div class="navbar-header">

                            <!--logo-->
                            <a href="main.html" class="navbar-brand smooth-scroll">
                                <img src="images/Front_images/images/logo.png" alt="logo">
                            </a>
                        </div>

                        <!--main menu-->
                        <div class="container">
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav pull-right">
                                    <li><a class="smooth-scroll" href="noteslisting.php">Search Notes</a></li>
                                    <li><a class="smooth-scroll" href="dashboard.php">Sell Your Notes</a></li>
                                    <li><a class="smooth-scroll" href="faq.php">FAQ</a></li>
                                    <li><a class="smooth-scroll" href="#services">Service</a></li>
                                    <li><a class="smooth-scroll" href="contact.php">Contact Us</a></li>
                                    <li>
                                        <div class="dropdown">
                                        <?php 
                                            $userid= $_SESSION['id'];
                                            $query="SELECT * From userprofile WHERE userid='$userid'";
                                            $result=mysqli_query($connection,$query);
                                            if($row=mysqli_fetch_assoc($result)){
                                                $profilepicture=$row['profilepic'];
                                            }
                                        ?>
                                        <input type="image" style="border-radius:50%;" src="../uploaded/<?php echo $profilepicture; ?>" class="smooth-scroll dropbtn img-responsive" onclick="myFunction()">
                                            <div id="myDropdown" class="dropdown-content">
                                                <a href="userprofile.php">Update Profile</a>
                                                <a href="mydownloads.php">My Downloads</a>
                                                <a href="mysoldnotes.php">My Sold Notes</a>
                                                <a href="myrejectednotes.php">My Rejected Notes</a>
                                                <a href="cpass.php">Change Password</a>
                                                <a href="login.php" style="color:#6255a5;text-transform:uppercase;">Logout</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="smooth-scroll" href="logout.php"><button onclick="return confirm('Are you sure, you want to logout?');" id=logoutbtn>Logout</button></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--main menu end-->
                    </div>
               </div>
                
            </nav>
            
        </header>
        <!--Header End-->
        
        <!--User Profile BG-->
        <section id="profilebackground">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                           <div id="profilebg">
                               <h2>User Profile</h2>
                           </div>
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--User Profile BG End-->
  
<?php
        $query="SELECT * FROM userprofile WHERE userid=$userid";
        $result=mysqli_query($connection,$query);
        
        if($row=mysqli_fetch_assoc($result)){
            $phoneno=$row['phoneno'];
            $address1=$row['address1'];
            $address2=$row['address2'];
            $city=$row['city'];
            $state=$row['state'];
            $zipcode=$row['zipcode'];
            $country=$row['country'];
            $university=$row['university'];
            $college=$row['college'];
        }
        
    if(isset($_POST['submitbtn'])){
        
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $email=$_POST['email'];
        $dateofbirth=$_POST['dateofbirth'];
        $gender=$_POST['gender'];
        $countrycode=$_POST['countrycode'];
        $phoneno=$_POST['phone'];
        $address1=$_POST['address1'];
        $address2=$_POST['address2'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $zipcode=$_POST['zipcode'];
        $country=$_POST['country'];
        $university=$_POST['university'];
        $college=$_POST['college'];
        
        //profile picture
        $profile_pic = $_FILES['profilepicture'];
        $filename = $profile_pic['name'];
        $filetmp = $profile_pic['tmp_name'];
        $extention = explode('.', $filename);
        $filecheck = strtolower(end($extention));
        $fileextstored = array('jpg', 'png', 'jpeg');

        if (in_array($filecheck, $fileextstored)) {
            if (!is_dir("../uploaded/")) {
                mkdir('../uploaded/');
            }
            if (!is_dir("../uploaded/" . $userid)) {
                mkdir("../uploaded/" . $userid);
            }
            $destinationfile = '../uploaded/' . $userid . '/' . "PP_" . time() . '.' . $filecheck;
            move_uploaded_file($filetmp, $destinationfile);
            $query_pic = "UPDATE userprofile SET profilepic='$destinationfile' WHERE userid=$userid";
            $result_pic = mysqli_query($connection, $query_pic);
        } else {
            $valid_format_1 = false;
        }
    
        
        $query="UPDATE users SET firstname='$firstname',lastname='$lastname' WHERE id=$userid";
        $result=mysqli_query($connection,$query);
        
        $query="UPDATE userprofile SET secemail='$email',dob='$dateofbirth',gender='$gender',phoncountry='$countrycode',phoneno='$phoneno',address1='$address1',address2='$address2',city='$city',state='$state',zipcode='$zipcode',country='$country',university='$university',college='$college' ";
        $query.="WHERE userid='$userid'";

        $result = mysqli_query($connection,$query);
    }

?>
       
        <!--Basic profile-->
        <form action="userprofile.php" method="post" enctype="multipart/form-data">
           
            <section id="Basic">

                <div class="content-box-lg">

                    <div class="contanier">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Basic Profile Details</h2>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">First name &#42;</label><br>
                                    <input class="form-control" type="text" id="firstname" name="firstname" value="<?php if(isset($_GET['email'])){echo $fname;}?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Last name &#42;</label><br>
                                    <input class="form-control" type="text" id="lastname" name="lastname" value="<?php if(isset($_GET['email'])){echo $lname;}?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email &#42;</label><br>
                                    <input class="form-control" value="<?php if(isset($_GET['email'])){echo $email;}else{echo $emailfromtable; }?>" type="email" id="email" name="email" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dateoofbirth">Date of Birth</label><br>
                                    <input class="form-control" type="date" id="dateofbirth" name="dateofbirth">
                                </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-group">
                                   <label for="gender">Gender</label><br>
                                    <select class="form-control" style="height:50px;" id="gender" name="gender" size="1">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6">
                                    <label for="phonenumber">Phone Number</label><br>
                                    <div class="form-group">
                                       <div id="phonecode" style="display:flex;">
                                            <select name="countrycode" class="form-control" style="margin-left:20px;width:120px;height:50px;">
                                            <?php
                                                $query="SELECT * FROM countries";
                                                $result=mysqli_query($connection,$query);
                                                while($row=mysqli_fetch_assoc($result)){
                                                    $countrycode=$row['countrycode'];
                                                    echo "<option value='$countrycode'>$countrycode</option>";
                                                }
                                            ?>
                                            </select>
                                            <input class="form-control" style="width:570px" type="number" id="phone" name="phone" placeholder="Enter your phone number">
                                        </div>
                                    </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profilepicture">Profile Picture</label><br>
                                    <div class="uploadcont">
                                        <img src="images/Front_images/images/upload-file.png">
                                    </div>
                                    <input class="form-control" type="file" id="profilepicture" name="profilepicture">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!--Basic Profile Details End-->

            <!--Address Details profile-->
            <section id="address">

                <div class="content-box-lg">

                    <div class="contanier">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Address Details</h2>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address1">Address Line 1 &#42;</label><br>
                                    <input class="form-control" type="text" id="add1" name="address1">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address2">Address Line 2</label><br>
                                    <input class="form-control" type="text" id="add2" name="address2">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City &#42;</label><br>
                                    <input class="form-control" type="text" id="city" name="city">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="state">State &#42;</label><br>
                                    <input class="form-control" type="text" id="state" name="state">
                                </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="zipcode">ZipCode &#42;</label><br>
                                    <input class="form-control" type="number" id="zcode" name="zipcode">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country &#42;</label><br>
                                    <input class="form-control" type="text" id="country" name="country">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!--Address Details End-->

            <!--University and College Information-->
            <section id="collgeinfo">

                <div class="content-box-lg">

                    <div class="contanier">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>University and College Information</h2>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="university">University</label><br>
                                    <input class="form-control" type="text" id="uni" name="university">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="college">College</label><br>
                                    <input class="form-control" type="text" id="college" name="college">
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-general" id="submitbtn" name="submitbtn">Submit</button>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </section>
        </form>
        <!--College University Information End-->
        
        <footer>
            <!--Footer-->
            <div class="content-box-sm">

                <div class="contanier">

                    <div class="row">

                        <div class="col-md-6 text-left" id="copytext">
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
            <!--Footer End-->
            
        </footer>
        
    </body>
    
    <!--Jquery-->
    <script src="js/jquery.js"></script>

    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!--Owl carousel-->
    <script src="js/owl-carousel/owl.carousel.min.js"></script>

    <!--Custom JS-->
    <script src="js/userprofile.js"></script>

</html>