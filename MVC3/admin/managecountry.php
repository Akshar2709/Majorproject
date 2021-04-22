<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Manage Country</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/managecountry.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <?php include "../includes/adminheader.php"; ?>
        <!--Header End-->
        
        <?php
        
            if(isset($_GET['delete'])){
                $countryid=$_GET['delete'];
                
                $query="DELETE from countries WHERE id='$countryid'";
                $result=mysqli_query($connection,$query);
                
            }
        
        ?>
        
        <!-- Published note -->
        <section id="publishednote">
        
            <div class="content-box-lg">
        
                <div class="contanier">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <h2>Manage Country</h2>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        
                        <div class="col-md-12">
                           
                            <div class="col-md-12">
                               <div class="col-md-6 text-left">
                                   <button id="addcountry"><a href="addcountry.php">Add Country</a></button>
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
                               <div id="dataelements">
                                   <div class="items">
                                       
                                       <div class="inprogress-table table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">SR NO.</th>
                                                        <th scope="col">COUNTRY NAME</th>
                                                        <th scope="col">COUNTRY CODE</th>
                                                        <th scope="col">DATE ADDED</th>
                                                        <th scope="col">ADDED BY</th>
                                                        <th scope="col">ACTIVE</th>
                                                        <th scope="col">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   <?php 
                                                        
                                                        if(isset($_POST['search'])){
                                                            $search=$_POST['search'];
                                                            $query="SELECT c.*,u.firstname,u.lastname from countries c LEFT JOIN users u ON u.id=c.createdby ";
                                                            $query.="WHERE (u.firstname LIKE '%$search%' OR u.lastname LIKE '%$search%' OR c.name LIKE '%$search%' OR c.countrycode LIKE '%$search%')";
                                                            $result=mysqli_query($connection,$query);
                                                        }else {

                                                            $query="SELECT c.*,u.firstname,u.lastname from countries c LEFT JOIN users u ON u.id=c.createdby";
                                                            $result=mysqli_query($connection,$query);
                                                        }
                                                        if(mysqli_num_rows($result)){
                                                            while($row = mysqli_fetch_assoc($result)){
                                                                $countryid=$row['id'];
                                                                $countryname=$row['name'];
                                                                $countrycode=$row['countrycode'];
                                                                $date=$row['createddate'];
                                                                $firstname=$row['firstname'];
                                                                $lastname=$row['lastname'];
                                                                $active=$row['isactive'];
                                                                static $a=1;

                                                                echo "<tr>";
                                                                echo "<td scope='row'>";?><?php echo $a++."</td>";
                                                                echo "<td>$countryname</td>";
                                                                echo "<td>$countrycode</td>";
                                                                echo "<td>$date</td>";
                                                                echo "<td>";?><?php echo $firstname." ".$lastname."</td>";
                                                                echo "<td>";?><?php if($active==1){echo "YES";}else{echo "NO";} echo "</td>";
                                                                echo "</td>";
                                                                echo "<td class='dropdown'>";
                                                                echo "<a class='link-margin' href='addcountry.php?edit={$countryid}'><img src='images/Admin_images/images/edit.png'></a>";
                                                                echo "<a class='link-margin' style='margin-left:20px' href='managecountry.php?delete={$countryid}'><img src='images/Admin_images/images/delete.png'>
                                                                </a>";
                                                                echo "</td>";
                                                                echo "</tr>";
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
        <script src="js/managecountry.js"></script>
        
    </body>
</html>