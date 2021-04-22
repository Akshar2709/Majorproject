<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Add Administrator</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/addadmin.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <?php include "../includes/adminheader.php";?>
        <!--Header End-->
        
        <!--Basic profile-->
        <section id="myprofile">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                               <?php
                                   if(isset($_GET['edit'])){
                                        echo "<h2>Edit Administrator</h2>";
                                    }else{
                                        echo "<h2>Add Administrator</h2>";
                                    }
                                ?>
                            </div>
                        </div>
        
                    </div>
                    
                    <?php
                        $userid=$_SESSION['id'];
                        if(isset($_GET['edit'])){
                            $adminid=$_GET['edit'];
                            $query="SELECT * FROM users WHERE id='$adminid'";
                            $result=mysqli_query($connection,$query);
                            if($row=mysqli_fetch_assoc($result)){
                                $firstname=$row['firstname'];
                                $lastname=$row['lastname'];
                                $email=$row['emailID'];
                            }
                            $query="SELECT * FROM userprofile WHERE userid='$adminid'";
                            $result=mysqli_query($connection,$query);
                            if($row=mysqli_fetch_assoc($result)){
                                $phoneno=$row['phoneno'];
                            }
                            
                        }else{
                            if(isset($_POST['submitbtn'])){
                                
                                $firstname=$_POST['fname'];
                                $lastname=$_POST['lname'];
                                $email=$_POST['email'];
                                $phone=$_POST['phone'];
                                
                                $query="INSERT INTO users(roleid,firstname,lastname,emailID,createddate,createdby,isactive)";
                                $query.=" VALUES(3,'$firstname','$lastname','$email',now(),'$userid',1)";
                                
                                $result=mysqli_query($connection,$query);
                                $id=mysqli_insert_id($connection);
                                
                                $phonequery="INSERT INTO userprofile(userid,phoneno,createddate,createdby,isactive)";
                                $phonequery.=" VALUES(LAST_INSERT_ID(),'$phone',now(),'$userid',1)";
                                $result=mysqli_query($connection,$phonequery);

                                header("Location:manageadmin.php");
                            }
                            
                        }
                        if(isset($_POST['updatebtn'])){
                            $firstname=$_POST['fname'];
                            $lastname=$_POST['lname'];
                            $email=$_POST['email'];
                            $phone=$_POST['phone'];
                            $adminid=$_POST['adminid'];
                            
                            $query="UPDATE users u LEFT JOIN userprofile up ON u.id=up.userid SET u.firstname='$firstname',u.lastname='$lastname',u.emailID='$email',up.phoneno='$phone',modifieddate=now(),modifiedby='$userid' ";
                            $query.="WHERE u.id='$adminid'";
                            $result=mysqli_query($connection,$query);
                            /*
                            $phonequery="UPDATE userprofile SET phoneno='$phone',modifieddate=now(),modifiedby='$userid' ";
                            $phonequery.="WHERE userid='$adminid'";
                            $result=mysqli_query($connection,$phonequery);*/
                            header("Location:manageadmin.php");
                        }
                        
                        
                        
                    ?>
                    
                    <div class="row">
        
                        <div class="col-md-6">
                            <form action="addadmin.php" method="post">
                                <label for="fname">First Name &#42;</label><br>
                                <input class="form-control" type="text" value="<?php if(isset($_GET['edit'])){echo "$firstname";}?>" id="fname" name="fname" placeholder="Enter your first name">
                                
                                <label for="lname">Last Name &#42;</label><br>
                                <input class="form-control" for="lname" type="text" value="<?php if(isset($_GET['edit'])){echo "$lastname";}?>" id="lname" name="lname" placeholder="Enter your last name">
                                
                                <label for="email">Email &#42;</label><br>
                                <input class="form-control" for="email" type="email" value="<?php if(isset($_GET['edit'])){echo "$email";}?>" id="email" name="email" placeholder="Enter your email address">
                                
                                <label for="phone">Phone Number</label><br>
                                <div id="phonecode" style="display:flex;">
                                    <select class="form-control" style="margin-left:20px;width:120px;height:50px;">
                                    <?php
                                        $query="SELECT * FROM countries";
                                        $result=mysqli_query($connection,$query);
                                        while($row=mysqli_fetch_assoc($result)){
                                            $countrycode=$row['countrycode'];
                                            echo "<option value='$countrycode'>$countrycode</option>";
                                        }
                                    ?>
                                    </select>
                                    <input class="form-control" style="width:570px" type="number" id="phone" value="<?php if(isset($_GET['edit'])){echo "$phoneno";}?>" name="phone" placeholder="Enter your phone number">
                                </div>
                                
                                
                                <?php
                                    if(isset($_GET['edit'])){
                                        $adminid=$_GET['edit'];
                                        echo "<input type='text' value='$adminid' name='adminid' hidden>";
                                        echo "<button class='btn btn-general' id='submitbtn' name='updatebtn'>Update</button>";
                                    }else{
                                        echo "<button class='btn btn-general' id='submitbtn' name='submitbtn'>Submit</button>";
                                    }
                                ?>
                                
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