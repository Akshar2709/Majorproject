<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Add Type</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/addtype.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <?php include "../includes/adminheader.php";?>
        <!--Header End-->
        
        <!--Add Category-->
        <section id="myprofile">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <?php
                                   if(isset($_GET['edit'])){
                                        echo "<h2>Edit Type</h2>";
                                    }else{
                                        echo "<h2>Add Type</h2>";
                                    }
                                ?>
                                
                            </div>
                        </div>
        
                    </div>
                    
                    <?php
                        $userid=$_SESSION['id'];
                        if(isset($_GET['edit'])){
                            $typeid=$_GET['edit'];
                            $query="SELECT * FROM notetypes WHERE id='$typeid'";
                            $result=mysqli_query($connection,$query);
                            if($row=mysqli_fetch_assoc($result)){
                                $type=$row['name'];
                                $description=$row['descrption'];
                            }
                            
                        }else{
                            if(isset($_POST['submitbtn'])){
                                $type=$_POST['type'];
                                $description=$_POST['description'];

                                $query="INSERT INTO notetypes(name,descrption,createddate,createdby,isactive)";
                                $query.=" VALUES('$type','$description',now(),'$userid',1)";

                                $result=mysqli_query($connection,$query);
                                header("Location:managetype.php");
                            }
                            
                        }
                        if(isset($_POST['updatebtn'])){
                            $type=$_POST['type'];
                            $typeid=$_POST['typeid'];
                            $description=$_POST['description'];

                            $query="UPDATE notetypes SET name='$type',descrption='$description',modifieddate=now(),modifiedby='$userid' ";
                            $query.="WHERE id='$typeid'";
                            $result=mysqli_query($connection,$query);
                            header("Location:managetype.php");
                        }
                        
                        
                        
                    ?>
                    
                    <div class="row">
        
                        <div class="col-md-6">
                            <form action="addtype.php" method="post">
                                <label for="type">Type &#42;</label><br>
                                <input class="form-control" type="varchar" value="<?php if(isset($_GET['edit'])){echo $type; }?>" id="type" name="type" placeholder="Enter your type">
                                
                                <label for="description">Description &#42;</label><br>
                                <textarea class="form-control" id="des" name="description" placeholder="Enter your description" cols="30" rows="10"><?php if(isset($_GET['edit'])){echo $description;} ?></textarea>
                                
                                <?php
                                    if(isset($_GET['edit'])){
                                        $typeid=$_GET['edit'];
                                        echo "<input type='text' value='$typeid' name='typeid' hidden>";
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
        <!--Add Category End-->
        
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