<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Manage Category</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/addcategory.css">
        
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
                                        echo "<h2>Edit Category</h2>";
                                    }else{
                                        echo "<h2>Add Category</h2>";
                                    }
                                ?>
                            </div>
                        </div>
        
                    </div>
                    
                    <?php
                        $userid=$_SESSION['id'];
                        if(isset($_GET['edit'])){
                            $typeid=$_GET['edit'];
                            $query="SELECT * FROM notecategories WHERE id='$typeid'";
                            $result=mysqli_query($connection,$query);
                            if($row=mysqli_fetch_assoc($result)){
                                $category=$row['name'];
                                $description=$row['descrption'];
                            }
                            
                        }else{
                            if(isset($_POST['submitbtn'])){
                                $category=$_POST['category'];
                                $description=$_POST['description'];

                                $query="INSERT INTO notecategories(name,descrption,createddate,createdby,isactive)";
                                $query.=" VALUES('$category','$description',now(),'$userid',1)";

                                $result=mysqli_query($connection,$query);
                                header("Location:managecat.php");
                            }
                            
                        }
                        if(isset($_POST['updatebtn'])){
                            $category=$_POST['category'];
                            $categoryid=$_POST['categoryid'];
                            $description=$_POST['description'];

                            $query="UPDATE notecategories SET name='$category',descrption='$description',modifieddate=now(),modifiedby='$userid' ";
                            $query.="WHERE id='$tcategoryid'";
                            $result=mysqli_query($connection,$query);
                            header("Location:managecat.php");
                        }
                        
                        
                        
                    ?>
                    
                    <div class="row">
        
                        <div class="col-md-6">
                            <form action="addcategory.php" method="post">
                                <label for="category">Category Name &#42;</label><br>
                                <input class="form-control" type="text" id="category" value="<?php if(isset($_GET['edit'])){echo $category; }?>" name="category" placeholder="Enter your category name">
                                
                                <label for="description">Description &#42;</label><br>
                                <textarea class="form-control" name="description" id="description" placeholder="Enter your description" cols="25" rows="10"><?php if(isset($_GET['edit'])){echo $description; }?></textarea>
                                
                                <?php
                                    if(isset($_GET['edit'])){
                                        $categoryid=$_GET['edit'];
                                        echo "<input type='text' value='$categoryid' name='categoryid' hidden>";
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