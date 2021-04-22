<?php include "../includes/db.php";?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Member Detalils</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/memberdetails.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <?php include "../includes/adminheader.php";?>
        <!--Header End-->
        
        <?php 
            if(isset($_GET['memberid'])){
                $memberid=$_GET['memberid'];
                $query="SELECT * FROM userprofile up LEFT JOIN users u ON u.id=up.userid WHERE u.id='$memberid'";
                $result=mysqli_query($connection,$query);
                while($row=mysqli_fetch_assoc($result)){
                    $firstname=$row['firstname'];
                    $lastname=$row['lastname'];
                    $email=$row['emailID'];
                    $dateofbirth=$row['dob'];
                    $profilepicture=$row['profilepic'];
                    $phone=$row['phoneno'];
                    $address1=$row['address1'];
                    $address2=$row['address2'];
                    $city=$row['city'];
                    $state=$row['state'];
                    $zipcode=$row['zipcode'];
                    $country=$row['country'];
                    $university=$row['university'];
                    $college=$row['college'];
                }
                
        ?>
        
        
        <!--Member details-->
        <section id="memberdetails">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <h2>Member Details</h2>
                            </div>
                        </div>
        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div id="details">
                                
                                <div class="col-md-1">
                                   <div id="memberimg">
                                        <img src="<?php echo $profilepicture; ?>">
                                   </div>
                                </div>
                            
                                <div class="col-md-4">
                                   <div id="personalinfo">
                                       
                                       <div class="col-md-6">
                                            <p>First Name:</p>
                                        </div>
                                        <div class="col-md-6 info">
                                            <p><?php echo $firstname;?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Last Name:</p>
                                        </div>
                                        <div class="col-md-6 info">
                                            <p><?php echo $lastname;?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Email:</p>
                                        </div>
                                        <div class="col-md-6 info">
                                            <p><?php echo $email;?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>DOB:</p>
                                        </div>
                                        <div class="col-md-6 info">
                                            <p><?php echo $dateofbirth;?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Phone Number:</p>
                                        </div>
                                        <div class="col-md-6 info">
                                            <p><?php echo $phone; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>College/University:</p>
                                        </div>
                                        <div class="col-md-6 info">
                                            <p><?php echo $college;?></p>
                                        </div>
                                       
                                   </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-md-6">
                                        <p>Address 1:</p>
                                    </div>
                                    <div class="col-md-6 info">
                                        <p><?php echo $address1;?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Address 2:</p>
                                    </div>
                                    <div class="col-md-6 info">
                                        <p><?php echo $address2;?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>City:</p>
                                    </div>
                                    <div class="col-md-6 info">
                                        <p><?php echo $city;?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>State:</p>
                                    </div>
                                    <div class="col-md-6 info">
                                        <p><?php echo $state;?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Country:</p>
                                    </div>
                                    <div class="col-md-6 info">
                                        <p><?php echo $country;?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Zip Code:</p>
                                    </div>
                                    <div class="col-md-6 info">
                                        <p><?php echo $zipcode;?></p>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Member details End-->
        
        <!-- Notes -->
        <section id="notes">
        
            <div class="content-box-lg">
        
                <div class="contanier">
                   
                    <div class="row">
                        
                        <div class="col-md-12">
                           
                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Notes</h2>
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
                                                    <th scope="col">STATUS</th>
                                                    <th scope="col">DOWNLOADED NOTES</th>
                                                    <th scope="col">TOTAL EARNINGS</th>
                                                    <th scope="col">DATE ADDED</th>
                                                    <th scope="col">PUBLISHED DATE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php 

                                                    $query="SELECT * FROM sellernotes WHERE sellerid='$memberid'";
                                                    $result=mysqli_query($connection,$query);
                                                    
                                                    if(mysqli_num_rows($result)!=0){
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            $sellernoteid=$row['id'];
                                                            $publisheddate=$row['publisheddate'];
                                                            $createddate=$row['createddate'];
                                                            $title=$row['title'];
                                                            $category=$row['category'];
                                                            $status=$row['status'];
                                                            $price=$row['sellingprice'];
                                                            $selltype=$row['ispaid'];
                                                            $approvedby=$row['modifiedby'];
                                                            static $a=1;
                                                        ?>
                                                        <tr>
                                                            <td scope="row"><?php echo $a++;?></td>
                                                            <td><a href="../front/noteview.php?noteid=<?php echo $sellernoteid; ?>"><?php echo $title; ?></a></td>
                                                            <td><?php echo $category; ?></td>
                                                            <td><?php echo $status; ?></td>
                                                            <td>10</td>
                                                            <td>&#36;36</td>
                                                            <td><?php echo $createddate; ?></td>
                                                            <td><?php echo $publisheddate;?></td>
                                                            <td class="dropdown">
                                                                    <div id="dots" class="btn-group"><img class="dropdown-toggle" data-toggle="dropdown" style="margin-left:20px" aria-haspopup="true" aria-expanded="true" src="images/Admin_images/images/dots.png">
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                                                    <button class="text-left dropdown-item action-dropdown-item" type="">Download Notes</button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php 
                                                        }
                                                    }else{
                                                        echo "<h2 class='text-center' style='color:#6255a5;'>NO RECORD</h2>";
                                                    }
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
        <!--Notes End-->
        
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
        <script src="js/memberdetails.js"></script>
        
    </body>
</html>