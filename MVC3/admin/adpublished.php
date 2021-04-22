<?php include "../includes/db.php";?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Published Notes</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/adpublished.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <?php include "../includes/adminheader.php";?>
        <!--Header End-->
        
        <!-- Published note -->
        <section id="publishednote">
        
            <div class="content-box-lg">
        
                <div class="contanier">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <h2>Published Notes</h2>
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
                                        <option value="khyati">Khyati</option>
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
                            
                            <div class="col-md-12">
                              
                                <div class="col-md-12">
                                    <div class="inprogress-table table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">SR NO.</th>
                                                    <th scope="col">NOTE TITLE</th>
                                                    <th scope="col">CATAGORY</th>
                                                    <th scope="col">SELL TYPE</th>
                                                    <th scope="col">PRICE</th>
                                                    <th scope="col">SELLER</th>
                                                    <th scope="col"></th>
                                                    <th scope="col">PUBLISHED DATE</th>
                                                    <th scope="col">APPROVED BY</th>
                                                    <th scope="col">NUMBER OF<br>DOWNLOADS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php 
                                                    $userid=$_SESSION['id'];
                                                
                                                    if(isset($_POST['search'])){
                                                        $search=$_POST['search'];
                                                        $query="SELECT sn.*,u.firstname,u.lastname FROM users u RIGHT JOIN sellernotes sn ON u.id=sn.sellerid ";
                                                        $query.="WHERE (u.firstname LIKE '%$search%' OR u.lastname LIKE '%$search%' OR sn.title LIKE '%$search%' OR sn.category LIKE '%$search%' OR sn.status LIKE '%$search%' OR sn.ispaid LIKE '%$search%')"; 
                                                        $query.=" AND status=3 ORDER BY sn.publisheddate";
                                                        $result=mysqli_query($connection,$query);
                                                    }else {

                                                        $query="SELECT sn.*,u.firstname,u.lastname FROM users u RIGHT JOIN sellernotes sn ON u.id=sn.sellerid WHERE status=3 ORDER BY sn.publisheddate";
                                                        $result=mysqli_query($connection,$query);
                                                    }
                                                    
                                                    if(mysqli_num_rows($result)!=0){
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            $sellernoteid=$row['id'];
                                                            $date=$row['publisheddate'];
                                                            $title=$row['title'];
                                                            $sellerid=$row['sellerid'];
                                                            $category=$row['category'];
                                                            $status=$row['status'];
                                                            $price=$row['sellingprice'];
                                                            $selltype=$row['ispaid'];
                                                            $approvedby=$row['modifiedby'];
                                                            $firstname=$row['firstname'];
                                                            $lastname=$row['lastname'];
                                                            static $a=1;
                                                        ?>
                                                        <tr>
                                                            <td scope="row"><?php echo $a++;?></td>
                                                            <td><a href="../front/noteview.php?noteid=<?php echo $sellernoteid; ?>"><?php echo $title; ?></a></td>
                                                            <td><?php echo $category; ?></td>
                                                            <td><?php echo $selltype; ?></td>
                                                            <td><?php echo $price; ?></td>
                                                            <td><?php echo $firstname." ".$lastname;?></td>
                                                            <td><a href="memberdetails.php?memberid=<?php echo $sellerid;?>"><img src='images/Admin_images/images/eye.png'></a></td>
                                                            <td><?php echo $date; ?></td>
                                                            <td><?php echo $approvedby; ?></td>
                                                            <td><a href="addownload.php">
                                                                <?php 
                                                                    $result=mysqli_query($connection,"SELECT * FROM downloads WHERE noteid=$sellernoteid");
                                                                    echo mysqli_num_rows($result);
                                                                ?>
                                                            </a></td>
                                                            <td class="dropdown">
                                                                    <div id="dots" class="btn-group"><img class="dropdown-toggle" data-toggle="dropdown" style="margin-left:20px" aria-haspopup="true" aria-expanded="true" src="images/Admin_images/images/dots.png">
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                                                    <button class="text-left dropdown-item action-dropdown-item" type="">Download Note</button>
                                                                    <button class="text-left dropdown-item action-dropdown-item" type=""><a href="../front/noteview.php?noteid=<?php echo $sellernoteid; ?>">View More Details</a></button>
                                                                    <button class="text-left dropdown-item action-dropdown-item" type="">Unpublish</button>
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
        <script src="js/adpublished.js"></script>
        
    </body>
</html>