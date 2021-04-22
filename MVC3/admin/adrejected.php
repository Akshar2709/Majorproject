<?php include "../includes/db.php"; ?>
<?php session_start();?>
<!DOCTYPE hmtl>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Rejected Notes</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/adrejected.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <?php include "../includes/adminheader.php";?>
        <!--Header End-->
        
        <?php
        
            if(isset($_GET['status'])){
                $status=$_GET['status'];
                $noteid=$_GET['noteid'];
                $query="UPDATE sellernotes SET status=$status WHERE id='$noteid'";
                $result=mysqli_query($connection,$query);
                header("Location:notereview.php");
            }
            
        ?>
        
        <!-- Published note -->
        <section id="publishednote">
        
            <div class="content-box-lg">
        
                <div class="contanier">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <h2>Rejected Notes</h2>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        
                        <div class="col-md-12">
                           
                            <div class="col-md-12">
                               <div class="col-md-6">
                                    <label for="seller">Seller</label><br>
                                    <select id="seller" for="seller">
                                        <option>Select seller</option>
                                        <?php 
                                            $query="SELECT * from users WHERE roleid=2";
                                            $result=mysqli_query($connection,$query);
                                            while($row=mysqli_fetch_assoc($result)){
                                                $firstname=$row['firstname'];
                                                $lastname=$row['lastname'];
                                                echo "<option value='$firstname'>$firstname $lastname</option>";
                                            }
                                        ?>
                                    </select>
                               </div>
                               <div class="col-md-6 text-right">
                                   <form action="" method="post">
                                       <img src="images/Admin_images/images/search-icon.png">
                                        <input type="text" id="search" name="search">
                                        <button class="searchbtn">search</button>
                                    </form>
                               </div>
                            </div>
                            
                            <div class="col-md-12 note">
                              
                                <div class="col-md-12">
                                    <div class="inprogress-table table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">SR NO.</th>
                                                    <th scope="col">NOTE TITLE</th>
                                                    <th scope="col">CATAGORY</th>
                                                    <th scope="col">SELLER</th>
                                                    <th scope="col"></th>
                                                    <th scope="col">DATE EDITED</th>
                                                    <th scope="col">REJECTED BY</th>
                                                    <th scope="col">REMARKS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php 
                                                    $userid=$_SESSION['id'];
                                                
                                                    if(isset($_POST['search'])){
                                                        $search=$_POST['search'];
                                                        $query="SELECT sn.*,u.firstname,u.lastname FROM sellernotes sn LEFT JOIN users u ON u.id=sn.sellerid ";
                                                        $query.="WHERE (u.firstname LIKE '%$search%' OR u.lastname LIKE '%$search%' OR sn.title LIKE '%$search%' OR sn.category LIKE '%$search%' OR sn.status LIKE '%$search%' OR sn.ispaid LIKE '%$search%')"; 
                                                        $query.=" AND status=4 ORDER BY sn.publisheddate";
                                                        $result=mysqli_query($connection,$query);
                                                    }else {

                                                        $query="SELECT sn.*,u.firstname,u.lastname FROM sellernotes sn LEFT JOIN users u ON u.id=sn.sellerid WHERE status=4 ORDER BY sn.publisheddate";
                                                        $result=mysqli_query($connection,$query);
                                                    }
                                                    if(mysqli_num_rows($result)!=0){
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            $sellernoteid=$row['id'];
                                                            $sellerid=$row['sellerid'];
                                                            $date=$row['modifieddate'];
                                                            $rejectedby=$row['modifiedby'];
                                                            $title=$row['title'];
                                                            $sellerid=$row['sellerid'];
                                                            $category=$row['category'];
                                                            $status=$row['status'];
                                                            $price=$row['sellingprice'];
                                                            $selltype=$row['ispaid'];
                                                            $remarks=$row['adminremarks'];
                                                            $firstname=$row['firstname'];
                                                            $lastname=$row['lastname'];
                                                            static $a=1;
                                                ?> 
                                                        <tr>
                                                            <td scope="row"><?php echo $a++; ?></td>
                                                            <td class="text-color"><?php echo $title;?></td>
                                                            <td><?php echo $category; ?></td>
                                                            <td><?php
                                                            echo $firstname." ".$lastname;
                                                            ?>
                                                            </td>
                                                            <td><a href="memberdetails.php?memberid=<?php echo $sellerid;?>"><img src="images/Admin_images/images/eye.png"></a></td>
                                                            <td><?php echo $date; ?></td>
                                                            <td>
                                                               <?php  
                                                                    $result=mysqli_query($connection,"SELECT * FROM users WHERE id='$rejectedby'");
                                                                    while($row=mysqli_fetch_assoc($result)){
                                                                        $firstname=$row['firstname'];
                                                                        $lastname=$row['lastname'];
                                                                    }
                                                                    echo $firstname." ".$lastname;
                                                                
                                                                ?></td>
                                                            <td><?php echo $remarks; ?></td>
                                                            <td class="dropdown">
                                                                <div id='dots' class='btn-group'><img class='dropdown-toggle' data-toggle='dropdown' style='margin-left:20px' aria-haspopup='true' aria-expanded='true' src='images/Admin_images/images/dots.png'>
                                                                    <div class='dropdown-menu dropdown-menu-right dropdown-menu-lg-left'>
                                                                        <button class=' text-left dropdown-item action-dropdown-item' type=""><a href="adrejected.php?noteid=<?php echo $sellernoteid;?>&status=3">Approve</a></button>
                                                                        <button class=' text-left dropdown-item action-dropdown-item' type=""><a href="../front/noteview.php?noteid=<?php echo $sellernoteid;?>">View More Details</a></button>
                                                                        <button class=' text-left dropdown-item action-dropdown-item' type="">Download Note</button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php
                                                        }
                                                    }else{
                                                        echo "<h2 class='text-center' style='color:#6255a5;'>NO RECORD</h2>";
                                                    }
                                                ?>
                                                    
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
                                </div>
                                
                            </div>
                            
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Published Notes End-->
        
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
        
        <!--Jquery-->
        <script src="js/jquery.js"></script>
        
        <!--Bootstrap JS-->
        <script src="js/bootstrap/bootstrap.min.js"></script>
        
        <!--Owl carousel-->
        <script src="js/owl-carousel/owl.carousel.min.js"></script>
        
        <!--custom JS-->
        <script src="js/addownload.js"></script>
        
    </body>
</html>