<?php include "../includes/db.php"; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Edit Notes</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/addnotes.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <header>
            
            <nav class="navbar navbar-fixed-top">
               <div class="container-fluid">
                   <div class="site-nav-wrapper">

                        <div class="navbar-header">

                            <!--logo-->
                            <a href="main.html" class="navbar-brand smooth-scroll">
                                <img src="images/Front_images/images/logo.png" alt="logo" class="img-responsive">
                            </a>
                        </div>

                        <!--main menu-->
                        <div class="container">
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav pull-right">
                                    <li><a class="smooth-scroll" href="noteslisting.html">Search Notes</a></li>
                                    <li><a class="smooth-scroll" href="noteview.html">Sell Your Notes</a></li>
                                    <li><a class="smooth-scroll" href="buyerreq.html">Buyer Requests</a></li>
                                    <li><a class="smooth-scroll" href="faq.html">FAQ</a></li>
                                    <li><a class="smooth-scroll" href="contact.html">Contact Us</a></li>
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
                                                <a href="#">Update Profile</a>
                                                <a href="#">Change Password</a>
                                                <a href="#">logout</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="smooth-scroll" href="login.php"><button id=logoutbtn>Logout</button></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--main menu end-->
                    </div>
               </div>
                
            </nav>
            
        </header>
        <!--Header End-->
        
        <!--Add Note BG-->
        <section id="addnotebackground">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                           <div id="addnotebg">
                                <h2>Edit Notes</h2>
                           </div>
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--User Profile BG End-->
        
<?php

/*$sellerid=$_SESSION['id'];*/

if(isset($_POST['savebtn'])){
    
    $noteid=$_GET['id'];
    $status="1";
    $date=date('dd-mm-yy');
    $title=$_POST['title'];
    $category=$_POST['category'];
    $displaypicture=$_FILES['displaypicture']['name'];
    $displaypicture_temp=$_FILES['displaypicture']['tmp_name'];
    $uploadnotes=$_FILES['uploadnotes']['name'];
    $uploadnotes_temp=$_FILES['uploadnotes']['tmp_name'];
    $type=$_POST['type'];
    $noofpages=$_POST['noofpages'];
    $description=$_POST['description'];
    $country=$_POST['country'];
    $iname=$_POST['iname'];
    $coursename=$_POST['coursename'];
    $coursecode=$_POST['coursecode'];
    $professor=$_POST['professor'];
    $coursecode=$_POST['coursecode'];
    $sellfor=$_POST['sellfor'];
    $sellprice=$_POST['sellprice'];
    $notepre=$_FILES['notepre']['name'];
    $notepre_temp=$_FILES['notepre']['tmp_name'];
    
    move_uploaded_file($displaypicture_temp,'images/$displaypicture');
    move_uploaded_file($uploadnotes_temp,'images/$uploadnotes');
    move_uploaded_file($notepre_temp,'images/$notepre');
    

$query="UPDATE sellernotes SET status='$status',actionedby=1,adminremarks='wow',publisheddate=now(),title='$title',category='$category',displaypic='$displaypicture',uploadnotes='$uploadnotes',notetype='$type',noofpage='$noofpages',description='$description',university='$iname',country='$country',course='$coursename',coursecode='$coursecode,professor='$professor',ispaid='$sellfor',sellingprice='$sellprice',notespreview='$notepre',modifieddate=now(),modifiedby='$userid' ";
$query.="WHERE id='$noteid'";

$result = mysqli_query($connection,$query);
if(!$result){
    echo "Error".mysqli_error($connection);
}
    
}
   
else if(isset($_POST['savebtn'])){
    $noteid=$_GET['id'];
    $status="0";
    $date=date('dd-mm-yy');
    $title=$_POST['title'];
    $category=$_POST['category'];
    $displaypicture=$_FILES['displaypicture']['name'];
    $displaypicture_temp=$_FILES['displaypicture']['tmp_name'];
    $uploadnotes=$_FILES['uploadnotes']['name'];
    $uploadnotes_temp=$_FILES['uploadnotes']['tmp_name'];
    $type=$_POST['type'];
    $noofpages=$_POST['noofpages'];
    $description=$_POST['description'];
    $country=$_POST['country'];
    $iname=$_POST['iname'];
    $coursename=$_POST['coursename'];
    $coursecode=$_POST['coursecode'];
    $professor=$_POST['professor'];
    $coursecode=$_POST['coursecode'];
    $sellfor=$_POST['sellfor'];
    $sellprice=$_POST['sellprice'];
    $notepre=$_FILES['notepre']['name'];
    $notepre_temp=$_FILES['notepre']['tmp_name'];
    

$query="UPDATE sellernotes SET status='$status',actionedby=1,adminremarks='wow',publisheddate=now(),title='$title',category='$category',displaypic='$displaypicture',uploadnotes='$uploadnotes',notetype='$type',noofpage='$noofpages',description='$description',university='$iname',country='$country',course='$coursename',coursecode='$coursecode,professor='$professor',ispaid='$sellfor',sellingprice='$sellprice',notespreview='$notepre',modifieddate=now(),modifiedby='$userid' ";
$query.="WHERE id='$noteid'";

$result = mysqli_query($connection,$query);
if(!$result){
    echo "Error".mysqli_error($connection);
}
    
}

?>
       
       <?php
        
        if(isset($_GET['edit'])){
            $noteid =$_GET['edit'];
            
            $query="SELECT * from sellernotes WHERE id='$noteid'";
            $result=mysqli_query($connection,$query);
            
            while($row=mysqli_fetch_assoc($result)){
                $title=$row['title'];
                $category=$row['category'];
                $displaypic=$row['displaypic'];
                $uploadnotes=$row['uploadnotes'];
                $notetype=$row['notetype'];
                $noofpage=$row['noofpage'];
                $description=$row['description'];
                $university=$row['university'];
                $country=$row['country'];
                $course=$row['course'];
                $coursecode=$row['coursecode'];
                $professor=$row['professor'];
                $ispaid=$row['ispaid'];
                $sellingprice=$row['sellingprice'];
                $notespreview=$row['notespreview'];
            }
            
            
        }
        
        
        ?>
        <form action="addnotes.php?id=<?php echo $noteid; ?>" method="post" enctype="multipart/form-data">
            <!--Basic profile-->
            <section id="Basic">

                <div class="content-box-lg">

                    <div class="contanier">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Basic Note Details</h2>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="title">Title &#42;</label><br>
                                    <input class="form-control" value="<?php echo $title; ?>" type="text" id="title" name="title">
                                </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="category">Category &#42;</label><br>
                                    <select class="form-control" id="category" name="category" size="1">
                                        <option value="category1">Select Category</option>
                                        <option value="category1">Category1</option>
                                        <option value="category2">Category2</option>
                                        <option value="category3">Category3</option>
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="displaypicture">Display Picture</label><br>
                                    <div class="upload">
                                        <img src="images/Front_images/images/upload-file.png">
                                    </div>
                                    <input class="form-control" type="file" id="displaypicture" name="displaypicture">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="uploadnotes">Profile Picture</label><br>
                                    <div class="upload">
                                        <img src="images/Front_images/images/upload-note.png">
                                    </div>
                                    <input class="form-control" type="file" id="uploadnotes" name="uploadnotes">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type</label><br>
                                    <select class="form-control" id="type" name="type" size="1">
                                        <option value="type1">Select Type</option>
                                        <option value="type1">Type1</option>
                                        <option value="type2">Type2</option>
                                        <option value="type3">Type3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="noofpages">Number of Pages</label><br>
                                    <input class="form-control" value="<?php echo $noofpage; ?>" type="number" id="nop" name="noofpages">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label><br>
                                    <textarea class="col-md-12 form-control" id="description" name="description" cols="30" rows="10"><?php echo $description; ?>
                                    </textarea>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!--Basic Note Details End-->

            <!--Institution Info profile-->
            <section id="insitinfo">

                <div class="content-box-lg">

                    <div class="contanier">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Institution Information</h2>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country</label><br>
                                    <select class="form-control" id="country" name="country" size="1">
                                        <option value="india">Select Country</option>
                                        <option value="india">India</option>
                                        <option value="usa">USA</option>
                                        <option value="cananda">Canada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="from-group">
                                    <label for="iname">Insitution Name</label><br>
                                    <input class="form-control" value="<?php echo $university; ?>" type="text" id="iname" name="iname">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!--Institution Information End-->

            <!--Course Details-->
            <section id="coursedetails">

                <div class="content-box-lg">

                    <div class="contanier">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Course Details</h2>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="coursename">Course Name</label><br>
                                    <input class="form-control" value="<?php echo $course; ?>" type="text" id="cname" name="coursename">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="coursecode">Course Code</label><br>
                                    <input class="form-control" value="<?php echo $coursecode; ?>" type="text" id="ccode" name="coursecode">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="professor">Professor/Lecturer</label><br>
                                    <input class="form-control" value="<?php echo $professor; ?>" type="text" id="prof" name="professor">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!--Course Details End-->

            <!--Selling Information-->
            <section id="sellinfo">

                <div class="content-box-lg">

                    <div class="contanier">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Selling Information</h2>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sellfor">Sell For</label><br>
                                            <input type="radio" name="sellfor" checked>Free
                                            <input type="radio" name="sellfor">Paid
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sellprice">Sell Price</label><br>
                                            <input class="form-control" value="<?php echo $sellingprice; ?>" type="number" id="sprice" name="sellprice">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-general" name="savebtn" id="savebtn">Save</button>
                                            <button class="btn btn-general" name="publishbtn" id="publishbtn">Publish</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="notepre">Note Preview</label><br>
                                    <div class="upload">
                                        <img src="images/Front_images/images/upload-file.png">
                                    </div>
                                    <input class="form-control" type="file" id="notepre" name="notepre">
                                </div>
                            </div>
                            
                            .

                        </div>

                    </div>

                </div>

            </section>
        </form>
        <!--Selling Information End-->
        
        <footer>
            <!--Footer-->
            <div class="content-box-sm">

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
            <!--Footer End-->
            
        </footer>
        
    </body>
    
    
    
    <script src="js/addnotes.js"></script>
    
</html>