<?php include "../includes/db.php"; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>My Rejected Notes</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/myrejectednotes.css">
        
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
                                                <a href="login.php" style="color:#6455a5;">Logout</a>
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
        
        <!-- Inprogress Note -->
        <section id="inprogressnote">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
                        
                        <div class="col-md-12">
                           
                            <div class="col-md-12">
                               <div class="col-md-6">
                                    <div class="horizontal-heading">
                                        <h2>My Rejected Notes</h2>
                                    </div>
                               </div>
                               <div class="col-md-6 text-right" style="margin-top:20px">
                                   <form action="" method="post">
                                       <img src="images/Front_images/images/search-icon.png">
                                        <input type="text" id="search" name="search">
                                        <button class="searchbtn">search</button>
                                    </form>
                               </div>
                            </div>
                            
                            <div class="col-md-12">
                                
                                    
                                           <?php 
                                            
                                            $userid=$_SESSION['id'];

                                            if(isset($_POST['search'])){
                                                $search=$_POST['search'];
                                                $query="SELECT * from sellernotes ";
                                                $query.="WHERE (title LIKE '%$search%' OR category LIKE '%$search%' OR ispaid LIKE '%$search%')"; 
                                                $query.=" AND sellerid='$userid' and status=4";
                                                $result=mysqli_query($connection,$query);
                                            }else {

                                                $query="SELECT * from sellernotes WHERE sellerid='$userid' and status=4";
                                                $result=mysqli_query($connection,$query);
                                            }

                                            if(mysqli_num_rows($result)!=0){

                                                while($row = mysqli_fetch_assoc($result)){
                                                    $sellernoteid=$row['id'];
                                                    $date=$row['publisheddate'];
                                                    $title=$row['title'];
                                                    $remarks=$row['adminremarks'];
                                                    $category=$row['category'];
                                                    $price=$row['sellingprice'];
                                                    $paidstatus=$row['ispaid'];
                                                    static $a=1;
                                            ?>  
                                              <div class="rejected-notes-table table-responsive">
                                               <table class="table">
                                                <thead>
                                                    <tr>
                                                       <th scope="col">SR NO.</th>
                                                        <th scope="col">NOTE TITLE</th>
                                                        <th scope="col">CATAGORY</th>
                                                        <th scope="col">REMARKS</th>
                                                        <th scope="col">CLONE</th>
                                                        <th scope="col">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                <tr>
                                                    <td><?php echo $a++;?></td>
                                                    <td><a href="noteview.php?noteid=<?php echo $sellernoteid; ?>"><?php echo $title; ?></a></td>
                                                    <td><?php echo $category; ?></td>
                                                    <td><?php echo $remarks; ?></td>
                                                    <td><a href="editnotes.php?edit=<?php echo $sellernoteid;?>">Clone</a></td>
                                                    <td class="dropdown">
                                                        <div id="dots" class="btn-group"><img class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" src="images/Front_images/images/dots.png">
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                                                <button class="text-left dropdown-item action-dropdown-item" type=""><a href="myrejectednotes.php?noteid=<?php echo $sellernoteid; ?>">Download Note</a></button>
                                                            </div>
                                                        </div>
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
        
                </div>
        
            </div>
        
        </section>
        <!--Inprogress Note End-->
        
        <!--Footer-->
        <footer>
            
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
        
        <!--custom JS-->
        <script src="js/myrejectednotes.js"></script>
        
    </body>
</html>