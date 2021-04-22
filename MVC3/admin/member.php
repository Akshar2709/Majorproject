<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Members</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/member.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <?php include "../includes/adminheader.php";?>
        <!--Header End-->
        
        <?php
            if(isset($_GET['memberid'])){
                $memberid=$_GET['memberid'];
                $query="UPDATE users SET isactive=0 WHERE id=$memberid";
                $result=mysqli_query($connection,$query);
                
            }
            
        ?>
        
        <!-- Published note -->
        <section id="publishednote">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
                        
                        <div class="col-md-12">
                           
                            <div class="col-md-12">
                               <div class="col-md-6 text-left">
                                    <div class="horizontal-heading">
                                        <h2>Members</h2>
                                    </div>
                               </div>
                               <div class="col-md-6 text-right">
                                  <div id="searchbar" style="margin-top:30px;">
                                        <form action="" method="post">
                                            <img src="images/Admin_images/images/search-icon.png">
                                            <input type="text" id="search" name="search">
                                            <button class="searchbtn">search</button>
                                        </form>
                                  </div>
                               </div>
                            </div>
                            
                            <div class="col-md-12 note">
                               
                               <div id="dataelements">
                                   
                                   <div class="item" data-dot="1">
                                       
                                       <div class="col-md-12">
                                            <div class="inprogress-table table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">SR NO.</th>
                                                            <th scope="col">FIRSTNAME</th>
                                                            <th scope="col">LASTNAME</th>
                                                            <th scope="col">EMAIL</th>
                                                            <th scope="col">JOINING DATE</th>
                                                            <th scope="col">UNDER REVIEW<br>NOTES</th>
                                                            <th scope="col">PUBLISHED<br>NOTES</th>
                                                            <th scope="col">DOWNLOADED<br>NOTES</th>
                                                            <th scope="col">TOTAL<br>EXPENSES</th>
                                                            <th scope="col">TOTAL<br>EARNINGS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?php 
                                                            $userid=$_SESSION['id'];
                                                        
                                                            if(isset($_POST['search'])){
                                                                $search=$_POST['search'];
                                                                $query="SELECT * from users WHERE (firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR emailID LIKE '%$search%') AND roleid=2";
                                                                $result=mysqli_query($connection,$query);
                                                            }else {

                                                                $query="SELECT * from users WHERE roleid=2";
                                                                $result=mysqli_query($connection,$query);
                                                            }
                                                            if(mysqli_num_rows($result)!=0){
                                                                while($row = mysqli_fetch_assoc($result)){
                                                                    $memberid=$row['id'];
                                                                    $firstname=$row['firstname'];
                                                                    $lastname=$row['lastname'];
                                                                    $email=$row['emailID'];
                                                                    $joindate=$row['createddate'];
                                                                    static $a=1;
    ?>
                                                                    <tr>
                                                                    <td scope='row'><?php echo $a++; ?></td>
                                                                    <td><?php echo $firstname; ?></td>
                                                                    <td><?php echo $lastname; ?></td>
                                                                    <td><?php echo $email; ?></td>
                                                                    <td><?php echo $joindate; ?></td>
                                                                    <td><a href='notereview.php'>
                                                                        <?php 
                                                                            $review_result=mysqli_query($connection,"SELECT * FROM sellernotes WHERE status=1 AND sellerid=$memberid");
                                                                            echo mysqli_num_rows($review_result);
                                                                        ?>
                                                                    </a></td>
                                                                    <td><a href='adpublished.php'>
                                                                        <?php 
                                                                            $publish_result=mysqli_query($connection,"SELECT * FROM sellernotes WHERE status=3 AND sellerid=$memberid");
                                                                            echo mysqli_num_rows($publish_result);
                                                                        ?>
                                                                    </a></td>
                                                                    <td><a href='addownload.php'>
                                                                        <?php 
                                                                            $download_result=mysqli_query($connection,"SELECT * FROM downloads WHERE downloader=$memberid");
                                                                            echo mysqli_num_rows($download_result);
                                                                        ?>
                                                                    </a></td>
                                                                    <td>&#36;
                                                                        <?php 
                                                                            $exp_result=mysqli_query($connection,"SELECT * FROM downloads WHERE downloader=$memberid");
                                                                            $sum=0;
                                                                            while($row=mysqli_fetch_assoc($exp_result)){
                                                                                $sum+=$row['purchasedprice'];
                                                                            }
                                                                            echo $sum;
                                                                        ?>
                                                                    </td>
                                                                    <td>&#36;
                                                                        <?php 
                                                                            $ear_result=mysqli_query($connection,"SELECT * FROM downloads WHERE seller=$memberid");
                                                                            $sum=0;
                                                                            while($row=mysqli_fetch_assoc($ear_result)){
                                                                                $sum+=$row['purchasedprice'];
                                                                            }
                                                                            echo $sum;
                                                                        ?>    
                                                                    </td>
                                                                    <td class='dropdown'>
                                                                        <div id='dots' class='btn-group'><img class='dropdown-toggle' data-toggle='dropdown' style='margin-left:20px' aria-haspopup='true' aria-expanded='true' src='images/Admin_images/images/dots.png'>
                                                                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-lg-left'>
                                                                                <button class=' text-left dropdown-item action-dropdown-item' type=''><a href='memberdetails.php?memberid=<?php echo $memberid; ?>'>View More Details</a></button>
                                                                                <button class=' text-left dropdown-item action-dropdown-item' type=''><a href='member.php?memberid=<?php echo $memberid; ?>'>Deactivate</a></button>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    </tr>
                                                        <?php    
                                                                }
                                                            }else{
                                                                echo "<h2 class='text-center' style='color:#6255a5;'>NO RECORD FOUND</h2>";
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
        
        <!--custom JS-->
        <script src="js/member.js"></script>
        
    </body>
</html>