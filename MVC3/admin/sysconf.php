<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>System configuration</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/sysconf.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <?php include "../includes/adminheader.php"; ?>
        <!--Header End-->
        
        <!--Manage System Configuration-->
        <section id="sysconfig">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <h2>Manage System Configuration</h2>
                            </div>
                        </div>
        
                    </div>
                    
                    <?php
                        $userid=$_SESSION['id'];
                    
                        if(isset($_POST['submitbtn'])){
                            $supportemail=$_POST['supemail'];
                            $supportphone=$_POST['supphone'];
                            $email=$_POST['email'];
                            $fburl=$_POST['fburl'];
                            $twitterurl=$_POST['twitterurl'];
                            $linkedinurl=$_POST['linkurl'];
                            
                            $query_support_email = "INSERT INTO systemconfiguration (key,value,createdby,createddate,isactive) ";
                            $query_support_email.="VALUES ('supportemail','$supportemail','$userid',now(),1)";
                            $result_support_email = mysqli_query($connection, $query_support_email);
                            
                           /* $query_support_phone = "INSERT INTO systemconfiguration (key,value,createdby,createddate,isactive) ";
                            $query_support_phone.="VALUES ('supportphone','$supportphone','$userid',now(),1)";
                            $result_support_phone = mysqli_query($connection, $query_support_phone);
                            
                            $query_email = "INSERT INTO systemconfiguration (key,value,createdby,createddate,isactive) ";
                            $query_email.="VALUES ('email','$email','$userid',now(),1)";
                            $result_email = mysqli_query($connection, $query_email);
                            
                            $query_support_fburl = "INSERT INTO systemconfiguration (key,value,createdby,createddate,isactive) ";
                            $query_support_fburl.="VALUES ('fburl','$fburl','$userid',now(),1)";
                            $result_support_fburl = mysqli_query($connection, $query_support_fburl);
                            
                            $query_support_twitterurl = "INSERT INTO systemconfiguration (key,value,createdby,createddate,isactive) ";
                            $query_support_twitterurl.="VALUES ('twitterurl','$twitterurl','$userid',now(),1)";
                            $result_support_twitterurl = mysqli_query($connection, $query_support_twitterurl);
                            
                            $query_support_linkedinurl = "INSERT INTO systemconfiguration (key,value,createdby,createddate,isactive) ";
                            $query_support_linkedinurl.="VALUES ('linkedinurl','$linkedinurl','$userid',now(),1)";
                            $result_support_linkedinurl = mysqli_query($connection, $query_support_linkedinurl);*/
                            
                            /* //default image
                            $default_image = $_FILES['defaultimage'];
                            $filename = $default_image['name'];
                            $filetmp = $default_image['tmp_name'];
                            $extention = explode('.', $filename);
                            $filecheck = strtolower(end($extention));
                            $fileextstored = array('jpg', 'png', 'jpeg');

                            if (in_array($filecheck, $fileextstored)) {
                                if (!is_dir("../uploaded/default/image/")) {
                                    mkdir('../uploaded/default/image/');
                                }
                                $destinationfile1 = '../uploaded/default/image/'  . "DP_" . time() . '.' . $filecheck;
                                move_uploaded_file($filetmp, $destinationfile1);
                                $query_pic = "INSERT INTO systemconfiguration (key,value,createdby,createddate,isactive) ";
                                $query_pic.="VALUES ('defaultimage','$destinationfile1','$userid',now(),1)";
                                $result_pic = mysqli_query($connection, $query_pic);
                            } else {
                                $valid_format_1 = false;
                            }
                            
                             //default profile
                            $default_profile = $_FILES['defaultprofile'];
                            $filename = $default_profile['name'];
                            $filetmp = $default_profile['tmp_name'];
                            $extention = explode('.', $filename);
                            $filecheck = strtolower(end($extention));
                            $fileextstored = array('jpg', 'png', 'jpeg');

                            if (in_array($filecheck, $fileextstored)) {
                                if (!is_dir("../uploaded/default/profile/")) {
                                    mkdir('../uploaded/default/profile/');
                                }
                                $destinationfile = '../uploaded/default/profile' . "DP_" . time() . '.' . $filecheck;
                                move_uploaded_file($filetmp, $destinationfile);
                                $query_profile = "INSERT INTO systemconfiguration (key,value,createdby,createddate,isactive) ";
                                $query_profile.="VALUES ('defaultprofile','$destinationfile','$userid',now(),1)";
                                $result_profile = mysqli_query($connection, $query_profile);
                            } else {
                                $valid_format_1 = false;
                            }*/
                            
                        }
                    ?>
                    
                    <div class="row">
        
                        <div class="col-md-6">
                            <form action="sysconf.php" method="post">
                                <label for="supemail">Support emails address &#42;</label><br>
                                <input type="text" id="supemail" name="supemail" placeholder="Enter email address">
                                
                                <label for="supphone">Support phone number &#42;</label><br>
                                <input type="text" id="supphone" name="supphone" placeholder="Enter phone number">
                                
                                <label for="email">Email Address(es)(for various events system will send notification to these users) &#42;</label><br>
                                <input type="text" id="email" name="email" placeholder="Enter email address">
                                
                                <label for="fburl">Facebook URL</label><br>
                                <input type="text" id="fburl" name="fburl" placeholder="Enter facebook url">
                                
                                <label for="twitterurl">Twitter URL</label><br>
                                <input type="text" id="twitterurl" name="twitterurl" placeholder="Enter twitter url">
                                
                                <label for="fburl">Linkedin URL</label><br>
                                <input type="text" id="linkurl" name="linkurl" placeholder="Enter linkedin url">
                                
                                <label for="defaultimage">Default image for notes (if seller do not upload)</label><br>
                                <div class="upload">
                                    <img src="images/Admin_images/images/upload-file.png">
                                </div>
                                <input type="file" id="defaultimage" name="defaultimage">
                                
                                <label for="defaultprofile">Default profile picture (if seller do not upload)</label><br>
                                <div class="upload">
                                    <img src="images/Admin_images/images/upload-file.png">
                                </div>
                                <input type="file" id="defaultprofile" name="defaultprofile">
                                
                                <button class="btn btn-general" name="submitbtn" id="submitbtn">Submit</button>
                            </form>
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Manage system configuration End-->
        
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