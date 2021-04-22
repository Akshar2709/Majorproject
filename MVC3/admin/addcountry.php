<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Add Country</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/addcountry.css">
        
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
                                        echo "<h2>Edit Country</h2>";
                                    }else{
                                        echo "<h2>Add Country</h2>";
                                    }
                                ?>
                            </div>
                        </div>
        
                    </div>
                    
                    <?php
                        $userid=$_SESSION['id'];
                        if(isset($_GET['edit'])){
                            $countryid=$_GET['edit'];
                            $query="SELECT * FROM countries WHERE id='$countryid'";
                            $result=mysqli_query($connection,$query);
                            if($row=mysqli_fetch_assoc($result)){
                                $country=$row['name'];
                                $countrycode=$row['countrycode'];
                            }
                            
                        }else{
                            if(isset($_POST['submitbtn'])){
                                $country=$_POST['countryname'];
                                $countrycode=$_POST['countrycode'];

                                $query="INSERT INTO countries(name,countrycode,createddate,createdby,isactive)";
                                $query.=" VALUES('$country','$countrycode',now(),'$userid',1)";

                                $result=mysqli_query($connection,$query);
                                header("Location:managecountry.php");
                            }
                            
                        }
                        if(isset($_POST['updatebtn'])){
                            $country=$_POST['countryname'];
                            $countryid=$_POST['countryid'];
                            $countrycode=$_POST['countrycode'];

                            $query="UPDATE countries SET name='$country',countrycode='$countrycode',modifieddate=now(),modifiedby='$userid' ";
                            $query.="WHERE id='$countryid'";
                            $result=mysqli_query($connection,$query);
                            header("Location:managecountry.php");
                        }
                        
                        
                        
                    ?>
                    
                    <div class="row">
        
                        <div class="col-md-6">
                            <form action="addcountry.php" method="post">
                                <label for="countryname">Country Name &#42;</label><br>
                                <input class="form-control" type="text" id="countryname" value="<?php if(isset($_GET['edit'])){echo $country; }?>" name="countryname" placeholder="Enter your country name">
                                
                                <label for="countrycode">Country Code &#42;</label><br>
                                <input class="form-control" for="countrycode" type="text" id="countrycode" value="<?php if(isset($_GET['edit'])){echo $countrycode; }?>" name="countrycode" placeholder="Enter your country code">
                                
                                <?php
                                    if(isset($_GET['edit'])){
                                        $countryid=$_GET['edit'];
                                        echo "<input type='text' value='$countryid' name='countryid' hidden>";
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