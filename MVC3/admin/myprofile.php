<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
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
        <link rel="stylesheet" href="css/myprofile.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <?php include "../includes/adminheader.php";?>
        <!--Header End-->
        
<?php

$userid=$_SESSION['id'];

if(isset($_POST['submitbtn'])){
    
    $firstname=$_POST['fname'];
    $lastname=$_POST['lname'];
    $email=$_POST['email'];
    $secondaryemail=$_POST['secemail'];
    $phone=$_POST['phone'];
    $countrycode=$_POST['countrycode'];

    $query="UPDATE users SET firstname='$firstname',lastname='$lastname',emailID='$email' ";
    $query.="WHERE id='$userid'";

    $result = mysqli_query($connection,$query);
    if(!$result){
        echo "Error".mysqli_error($connection);
    }

    $query="UPDATE userprofile SET secemail='$secondaryemail',phoncountry='$countrycode',phoneno='$phone' ";
    $query.="WHERE userid='$userid'";
    
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
    
    
}
?>
        
        <!--Basic profile-->
        <section id="myprofile">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <h2>My Profile</h2>
                            </div>
                        </div>
        
                    </div>
                    
                    <div class="row">
                        <?php 
                            $query="SELECT * FROM users u INNER JOIN userprofile up ON u.id=up.userid WHERE u.id='$userid'";
                            $result = mysqli_query($connection,$query);
                            if(!$result){
                                echo "Error".mysqli_error($connection);
                            }
                            if($row=mysqli_fetch_assoc($result)){
                                $firstname=$row['firstname'];
                                $lastname=$row['lastname'];
                                $email=$row['emailID'];
                                $phonenumber=$row['phoneno'];
                                $countrycode=$row['phoncountry'];
                                $secondaryemail=$row['secemail'];
                            }
                        ?>
        
                        <div class="col-md-6">
                            <form>
                                <label for="fname">First Name &#42;</label><br>
                                <input type="text" id="fname" value="<?php echo $firstname; ?>" name="fname" placeholder="Enter your first name">
                                
                                <label for="lname">Last Name &#42;</label><br>
                                <input for="lname" type="text" value="<?php echo $lastname; ?>" id="lname" name="lname" placeholder="Enter your last exam">
                                
                                <label for="email">Email &#42;</label><br>
                                <input for="email" type="email" value="<?php echo $email; ?>" id="email" name="email" placeholder="Enter your email address">
                                
                                <label for="secemail">Secondary Email</label><br>
                                <input for="secemail" type="email" value="<?php echo $secondaryemail;?>" id="secemail" name="secemail" placeholder="Enter your email address">
                                
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
                                        <input class="form-control" style="width:570px" value="<?php echo $phonenumber; ?>" type="number" id="phone" name="phone" placeholder="Enter your phone number">
                                    </div>
                                </div>
                                
                                <label for="profilepicture">Display Picture</label><br>
                                <div class="upload">
                                    <img src="images/Admin_images/images/upload-file.png">
                                </div>
                                <input type="file" id="profilepicture" name="profilepicture">
                                
                                <button id="submitbtn" name="submitbtn" type="button">Submit</button>
                                
                            </form>
                        </div>
                        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Basic Note Details End-->
        
        <footer>
            <!--Footer-->
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
            <!--Footer End-->
            
        </footer>
        
    </body>
</html>