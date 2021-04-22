<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Dashboard</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Responsive CSS-->
        <link rel="stylesheet" href="css/responsive.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/dashboard.css">
        
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
                                <img src="images/Front_images/images/logo.png" alt="logo">
                            </a>
                            
                        </div>

                        <!--main menu-->
                        <div class="container">
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav pull-right">
                                    <li><a class="smooth-scroll" href="noteslisting.php">Search Notes</a></li>
                                    <li><a class="smooth-scroll" href="dashboard.php">Sell Your Notes</a></li>
                                    <li><a class="smooth-scroll" href="buyerreq.php">Buyer Requests</a></li>
                                    <li><a class="smooth-scroll" href="faq.php">FAQ</a></li>
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
                        <!-- Mobile Menu -->
                        <div id="m-nav">
                            <!-- Mobile Menu Close Button -->
                            <span id="m-nav-x-btn">&times;</span>
                            <div id="m-nav-content">
                                <ul class="nav">
                                     <li><a href="noteslisting.php">Search Notes</a></li>
                                    <li><a href="dashboard.php" style="color: #6255a5";>Sell Your Notes</a></li>
                                    <li><a href="faq.php">FAQ</a></li>
                                    <li><a href="contact.php">Contact Us</a></li>
                                    <li><a href="login.php"><button type="button" class="btn btn-work btn-login smooth-scroll">Logout</button></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
               </div>
                
            </nav>
            
        </header>
        <!--Header End-->
        
        <?php $userid=$_SESSION['id']; ?>
        
        <?php
        
            if(isset($_GET['delete'])){
                $sellerid=$_GET['delete'];
                
                $query="DELETE from sellernotes WHERE id='$sellerid'";
                $result=mysqli_query($connection,$query);
                
            }
        
        ?>
        
        <!-- Dashboard -->
        <section id="dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p id="p-dashboard">Dashboard</p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <button id="addnote"><a href="addnotes.php">Add Note</a></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 dashboard-detalis">
                        <div class="col-md-4 col-sm-4 col-xs-12 earning">
                            <div class="div-content text-center">
                                <img src="images/Front_images/images/earning-icon.svg" class="img-responsive" alt="earning">
                                <p>My Earning</p>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12 earning">
                            <div class="col-md-6 col-sm-6 earning-1">
                                <div class="div-content text-center">
                                    <p><a href="mydownloads.php"><?php
                                        $query="SELECT * FROM downloads WHERE seller='$userid' AND isattachmentdownloaded=1";
                                        $result=mysqli_query($connection,$query);
                                        echo mysqli_num_rows($result);
                                        ?></a></p>
                                    <p>Number of Notes Sold</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 text-center earning-1">
                                <div class="div-content">
                                    <p>&#36;<?php
                                        $query="SELECT * FROM downloads WHERE seller='$userid' AND isattachmentdownloaded=1";
                                        $result=mysqli_query($connection,$query);
                                        $sum=0;
                                        while($row=mysqli_fetch_assoc($result)){
                                            $sum = $row['purchasedprice'];
                                        }
                                        echo $sum;
                                        ?></p>
                                    <p>Money Earned</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                            <div class="earning">
                                <div class="div-content">
                                    <p><a href="mydownloads.php"><?php
                                        $query="SELECT * FROM downloads WHERE downloader='$userid' AND isattachmentdownloaded='1'";
                                        $result=mysqli_query($connection,$query);
                                        echo mysqli_num_rows($result);
                                        ?></a></p>
                                    <p>My Downloads</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                            <div class="earning">
                                <div class="div-content">
                                    <p><a href="myrejectednotes.php"><?php
                                        $query="SELECT * FROM sellernotes WHERE sellerid='$userid' AND status=4";
                                        $result=mysqli_query($connection,$query);
                                        echo mysqli_num_rows($result);
                                        ?></a></p>
                                    <p>My Rejected Notes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                            <div class="earning">
                                <div class="div-content">
                                    <p><a href="buyerreq.php"><?php
                                        $query="SELECT * FROM downloads WHERE seller='$userid'";
                                        $result=mysqli_query($connection,$query);
                                        echo mysqli_num_rows($result);
                                        ?></a></p>
                                    <p>Buyer Requests</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Notes Details End-->

            <!-- Inprogress Note -->
            <div class="inprogress">
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <p>In Progress Notes</p>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 text-right">
                            <div class="dashboard-search">
                               <form action="" method="post">
                                    <!--<div class="col-md-8 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="search">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4" id="search">
                                        <a class="btn-general btn-work smooth-scroll" title="search" role="button">Search</a>
                                    </div>-->
                                    <input type="text" id="search" name="search">
                                    <button class="searchbtn">search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            
                                    
                                       <?php 
                                            $userid=$_SESSION['id'];
                                            
                                            if(isset($_POST['search'])){
                                                $search=$_POST['search'];
                                                $query="SELECT * from sellernotes ";
                                                $query.="WHERE (title LIKE '%$search%' OR category LIKE '%$search%' OR status LIKE '%$search%')"; 
                                                $query.=" AND sellerid='$userid' AND (status=0 OR status=1)";
                                                $result=mysqli_query($connection,$query);
                                            }else {

                                                $query="SELECT * from sellernotes WHERE sellerid='$userid' AND (status=0 OR status=1)";
                                                $result=mysqli_query($connection,$query);
                                            }

                                            if(mysqli_num_rows($result)!=0){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $sellernoteid=$row['id'];
                                                    $date=$row['publisheddate'];
                                                    $date=date("d M Y",strtotime($date));
                                                    $title=$row['title'];
                                                    $category=$row['category'];
                                                    $status=$row['status'];
                                        ?>
                                              <div class="inprogress-table table-responsive">
                                                <table class="table">
                                               <thead>
                                                <tr>
                                                    <th scope="col">ADDED DATE</th>
                                                    <th scope="col">TITLE</th>
                                                    <th scope="col">CATAGORY</th>
                                                    <th scope="col">STATUS</th>
                                                    <th scope="col">ACTION</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                <td scope='row'><?php echo $date; ?></td>
                                                <td class='text-color'><?php echo $title; ?></td>
                                                <td><?php echo $category; ?></td>
                                                <td>
                                                <?php if($status==0){
                                                    echo "Draft";}else{
                                                    echo "In Review"; }
                                                ?>
                                                </td>
                                                <td class='dropdown'>
                                                <?php if($status==0){
                                                    echo "<a class='link-margin' href='editnotes.php?edit={$sellernoteid}'><img src='images/Front_images/images/edit.png'></a>";
                                                    echo "<a class='link-margin' style='margin-left:20px' href='dashboard.php?delete={$sellernoteid}'><img src='images/Front_images/images/delete.png'></a>";
                                                }else{
                                                    echo "<a class='link-margin' href='noteview.php?noteid={$sellernoteid}'><img src='images/Front_images/images/eye.png'></a>"; 
                                                }
                                                ?>
                                                </td>
                                                </tr>
                                                <!-- </thead> -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="text-center" aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="disabled"><a href="#">«</a></li>
                                                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#">5</a></li>
                                                        <li><a href="#">»</a></li>
                                                    </ul>
                                                </div>
                                           <?php 
                                            } 
                                            }else{
                                                echo "<h2 class='text-center' style='color:#6255a5;'>NO RECORD FOUND</h2>";
                                            }
                                            ?>
                                        
                                        
                        </div>
                    </div>
            </div>
            <!--Inprogress Note End-->

            <!-- Published note -->
            <div class="published">
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <p>Published Notes</p>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 text-right">
                            <div class="dashboard-search">
                               <form action="" method="post">
                                    <!--<div class="col-md-8 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4" id="search">
                                        <a class="btn-general btn-work smooth-scroll" title="search" role="button">Search</a>
                                    </div>-->
                                    <input type="text" id="search" name="searchinput">
                                    <button class="searchbtn" name="searchbtn">search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            
                                    
                                        <?php 
                                        
                                            $userid=$_SESSION['id'];
                                            
                                            if(isset($_POST['searchbtn'])){
                                                $search=$_POST['searchinput'];
                                                $query="SELECT * from sellernotes ";
                                                $query.="WHERE (title LIKE '%$search%' OR category LIKE '%$search%' OR status LIKE '%$search%')"; 
                                                $query.=" AND sellerid='$userid' AND status=3";
                                                $result=mysqli_query($connection,$query);
                                            }else {

                                                $query="SELECT * from sellernotes WHERE sellerid='$userid' AND status=3";
                                                $result=mysqli_query($connection,$query);
                                            }
                                            
                                            if(mysqli_num_rows($result)!=0){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $sellernoteid=$row['id'];
                                                    $date=$row['publisheddate'];
                                                    $date=date("d M Y",strtotime($date));
                                                    $title=$row['title'];
                                                    $category=$row['category'];
                                                    $price=$row['sellingprice'];
                                                    $ispaid=$row['ispaid'];
                                            ?>   
                                               <div class="published-table table-responsive">
                                                <table class="table">
                                               <thead>
                                                <tr>
                                                    <th scope="col">ADDED DATE</th>
                                                    <th scope="col">TITLE</th>
                                                    <th scope="col">CATAGORY</th>
                                                    <th scope="col">SELL TYPE</th>
                                                    <th scope="col">PRICE</th>
                                                    <th scope="col">ACTION</th>
                                                </tr>
                                                </thead>
                                                <tbody> 
                                                <tr>
                                                <td scope='row'><?php echo $date; ?></td>
                                                <td class='text-color'><?php echo $title; ?></td>
                                                <td><?php echo $category; ?></td>
                                                <td><?php echo $ispaid; ?></td>
                                                <td><?php echo $price; ?></td>
                                                <td class='dropdown'>
                                                <a class='link-margin' href='noteview.php?noteid=<?php echo $sellernoteid; ?>'><img src='images/Front_images/images/eye.png'></a>
                                                </td>
                                                </tr>
                                                </tbody>
                                                    </table>
                                                </div>
                                                <div class="text-center" aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="disabled"><a href="#">«</a></li>
                                                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#">5</a></li>
                                                        <li><a href="#">»</a></li>
                                                    </ul>
                                                </div>
                                        <?php    
                                            }
                                            }else{
                                                echo "<h2 class='text-center' style='color:#6255a5;'>NO RECORD FOUND</h2>";
                                            }
                                        ?>
                                    
                        </div>
                    </div>
                </div>
            <!--Published Notes End-->
        </section>
        
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
        
        <!--Jquery-->
        <script src="js/jquery.js"></script>
        
        <!--Bootstrap JS-->
        <script src="js/bootstrap/bootstrap.min.js"></script>
        
        <!--Owl carousel-->
        <script src="js/owl-carousel/owl.carousel.min.js"></script>
        
        <!--Counter-->
        <script src="js/counter/jquery.counterup.min.js"></script> 
        
        <!--custom JS-->
        <script src="js/dashboard.js"></script>
        
    </body>
</html>