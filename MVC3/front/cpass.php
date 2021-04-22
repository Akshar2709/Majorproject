<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
   
    <head>
       
        <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Change Password</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/cpass.css">
        
    </head>
    
    <body>
        
        <!--Change Password Page-->
        <section id="changepass">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
                       
                       <div class="col-md-12">
                           <!--logo-->
                            <a href="main.html" class="navbar-brand logo">
                                <img src="images/Front_images/images/logo.png" alt="logo">
                            </a>
                       </div>
                       
                    </div>
                    
                    <div class="row">
                       <form name="changepasswordform" action="cpass.php" method="post" onsubmit="return validateform()">
                            <div id="changepasspart" >

                                <div class="col-md-12 text-center">
                                    <h2>Change Password</h2>
                                    <p>Enter your new password to change your password</p>
                                </div>
                                
                                <?php
                        
                                    $userid=$_SESSION['id'];

                                    if(isset($_POST['submitbtn'])){
                                        $oldpassword=$_POST['opassword'];
                                        $newpassword=$_POST['npassword'];

                                        $query="SELECT * from users WHERE id='$userid'";
                                        $result=mysqli_query($connection,$query);

                                        while($row=mysqli_fetch_assoc($result)){
                                            $passwordfromtable=$row['password'];
                                        }
                                        
                                        $hashformat="$2y$10$";
                                        $salt="iusesomecrazystrings22";
                                        $hashsalt=$hashformat.$salt;
                                        $oldpassword=crypt($oldpassword,$hashsalt);
                                        $newpassword=crypt($newpassword,$hashsalt);

                                        if($passwordfromtable!=$oldpassword){
                                            echo "<p class='text-center' id='notice'>The old password is not true!!</p>";
                                        }else{
                                            $query="UPDATE users SET password='$newpassword' WHERE id='$userid'";
                                            $result=mysqli_query($connection,$query);
                                            header:('Location: login.php');
                                        }

                                    }

                                ?>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="opassword">Old Password</label>
                                        <input id="opassword" class="form-control" type="password" name="opassword" placeholder="Enter your old password" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="npassword">New Password</label>
                                        <input id="npassword" class="form-control" type="password" name="npassword" placeholder="Enter your new password" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Cpassword">Confirm Password</label>
                                        <input id="cpassword" class="form-control" type="password" name="cpassword" placeholder="Enter your confirm password" required>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <button class="btn btn-general" name="submitbtn" id="submitbtn">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Change password End-->
        
    </body>
    
    <script src="js/cpass.js"></script>
    
</html>