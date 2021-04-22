<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Spam Reports</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/spamreport.css">
        
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
                           
                            <div class="col-md-12">
                               <div class="col-md-6 text-left">
                                    <div class="horizontal-heading">
                                        <h2>Spam Reports</h2>
                                    </div>
                               </div>
                               <div class="col-md-6 text-right" style="margin-top:30px;">
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
                                                    <th scope="col">REPORTED BY</th>
                                                    <th scope="col">NOTE TITLE</th>
                                                    <th scope="col">CATAGORY</th>
                                                    <th scope="col">DATE EDITED</th>
                                                    <th scope="col">REMARKS</th>
                                                    <th scope="col">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php 
                                                    /*$userid=$_SESSION['id'];*/
                                                    
                                                    if(isset($_POST['search'])){
                                                        $search=$_POST['search'];
                                                        $query="SELECT sn.*,sr.remarks,sr.modifieddate as srm,u.firstname,u.lastname FROM sellernotesreport sr LEFT JOIN sellernotes sn ON sn.id=sr.noteid LEFT JOIN users u ON u.id=sr.reportedbyid";
                                                        $query.="WHERE (u.firstname LIKE '%$search%' OR u.lastname LIKE '%$search%' OR sn.title LIKE '%$search%' OR sn.category LIKE '%$search%')"; 
                                                        $result=mysqli_query($connection,$query);
                                                    }else {

                                                        $query="SELECT sn.*,sr.remarks,sr.modifieddate as srm,u.firstname,u.lastname FROM sellernotesreport sr LEFT JOIN sellernotes sn ON sn.id=sr.noteid LEFT JOIN users u ON u.id=sr.reportedbyid";
                                                        $result=mysqli_query($connection,$query);
                                                    }
                                                
                                                    if(mysqli_num_rows($result)!=0){
                                                        while($row =mysqli_fetch_assoc($result)){
                                                            $sellernoteid=$row['id'];
                                                            $sellerid=$row['sellerid'];
                                                            $date=$row['srm'];
                                                            $date=date("d M Y",strtotime($date));
                                                            $title=$row['title'];
                                                            $category=$row['category'];
                                                            $remarks=$row['remarks'];
                                                            $firstname=$row['firstname'];
                                                            $lastname=$row['lastname'];
                                                            static $a=1;
                                                ?> 
                                                        <tr>
                                                            <td scope="row"><?php echo $a++; ?></td>
                                                            <td><?php echo $firstname." ".$lastname; ?></td>
                                                            <td class="text-color"><?php echo $title;?></td>
                                                            <td><?php echo $category; ?></td>
                                                            <td><?php echo $date; ?></td>
                                                            <td><?php echo $remarks; ?></td>
                                                            <td class="dropdown">
                                                                <div id='dots' class='btn-group'><img class='dropdown-toggle' data-toggle='dropdown' style='margin-left:20px' aria-haspopup='true' aria-expanded='true' src='images/Admin_images/images/dots.png'>
                                                                    <div class='dropdown-menu dropdown-menu-right dropdown-menu-lg-left'>
                                                                        <button class=' text-left dropdown-item action-dropdown-item' type=""><a href="spamreport.php?noteid=<?php echo $sellernoteid; ?>">Download Notes</a></button>
                                                                        <button class=' text-left dropdown-item action-dropdown-item' type=""><a href="../front/noteview.php?noteid=<?php echo $sellernoteid;?>">View More Details</a></button>
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
        <script src="js/member.js"></script>
        
    </body>
</html>