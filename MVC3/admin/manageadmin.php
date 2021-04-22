<?php include "../includes/db.php"; ?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Manage Administrator</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/manageadmin.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <?php include "../includes/adminheader.php"; ?>
        <!--Header End-->
        
        
        <?php
        
            if(isset($_GET['delete'])){
                $userid=$_GET['delete'];
                
                $query="DELETE from users WHERE id='$userid'";
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
                                <h2>Manage Administrator</h2>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        
                        <div class="col-md-12">
                           
                            <div class="col-md-12">
                               <div class="col-md-6 text-left">
                                   <button id="addadmin"><a href="addadmin.php">Add Administrator</a></button>
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
                                                            <th scope="col">FIRSTNAME</th>
                                                            <th scope="col">LASTNAME</th>
                                                            <th scope="col">EMAIL</th>
                                                            <th scope="col">PHONE NO</th>
                                                            <th scope="col">DATE ADDED</th>
                                                            <th scope="col">ACTIVE</th>
                                                            <th scope="col">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?php 
                                                        
                                                            if(isset($_POST['search'])){
                                                                $search=$_POST['search'];
                                                                $query="SELECT u.*,up.phoneno,up.phoncountry from users u LEFT JOIN userprofile up ON up.userid=u.id ";
                                                                $query.="WHERE (u.firstname LIKE '%$search%' OR u.lastname LIKE '%$search%' OR u.emailID LIKE '%$search%')";
                                                                $query.=" AND u.roleid='3'";
                                                                $result=mysqli_query($connection,$query);
                                                            }else {

                                                                $query="SELECT u.*,up.phoneno,up.phoncountry from users u LEFT JOIN userprofile up ON up.userid=u.id WHERE u.roleid='3'";
                                                                $result=mysqli_query($connection,$query);
                                                            }
                                                            if(mysqli_num_rows($result)!=0){
                                                                while($row = mysqli_fetch_assoc($result)){
                                                                    $userid=$row['id'];
                                                                    $firstname=$row['firstname'];
                                                                    $lastname=$row['lastname'];
                                                                    $email=$row['emailID'];
                                                                    $phoneno=$row['phoneno'];
                                                                    $countrycode=$row['phoncountry'];
                                                                    $active=$row['isactive'];
                                                                    $date=$row['createddate'];
                                                                    $date=date("d M Y,G:i:s",strtotime($date));
                                                                    static $a=1;
?>
                                                                    <tr>
                                                                        <td scope='row'><?php echo $a++; ?></td>
                                                                        <td><?php echo $firstname; ?></td>
                                                                        <td><?php echo $lastname; ?></td>
                                                                        <td><?php echo $email; ?></td>
                                                                        <td><?php if($countrycode!=0){echo "+";}echo $countrycode.$phoneno;?></td>
                                                                        <td><?php echo $date; ?></td>
                                                                        <td><?php if($active==1){echo "YES";}else{echo "NO";} ?></td>
                                                                        <td class="dropdown">
                                                                            <a class="link-margin" href="addadmin.php?edit=<?php echo $userid; ?>"><img src='images/Admin_images/images/edit.png'></a>
                                                                            <a class="link-margin" style='margin-left:20px' href='manageadmin.php?delete=<?php echo $userid ?>'><img src='images/Admin_images/images/delete.png'>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                            <?php    }
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
        <script src="js/manageadmin.js"></script>
        
    </body>
</html>