<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>User Profile</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/admindash.css">
        
    </head>
    
    <body>
        
        <?php include "../includes/adminheader.php"; ?>
        
        <?php
      //for downloading
        $buyerid=$_SESSION['id'];
        if (isset($_GET['noteid'])) {

            $noteid = $_GET['noteid'];
            $download_query = mysqli_query($connection, "SELECT notetitle,attachmentpath FROM downloads WHERE noteid=$noteid AND downloader=$buyerid");
            while ($row = mysqli_fetch_assoc($download_query)) {
                $note_path = $row['attachmentpath'];
                $note_title = $row['notetitle'];

                /*$download_count = mysqli_num_rows($download_query);
                if ($download_count == 1) {*/
                    header('Cache-Control: public');
                    header('Content-Description: File Transfer');
                    header('Content-Disposition: attachment; filename=' . $note_title . '.pdf');
                    header('Content-Type: application/pdf');
                    header('Content-Transfer-Encoding:binary');
                    readfile($note_path);

                    $attached_downloaded = mysqli_query($connection, "UPDATE downloads SET isattachmentdownloaded=1,attactmentdownloadeddate=NOW() WHERE noteid=$noteid AND downloader=$buyerid");
               /* }*/
                /*if ($download_count > 1) {
                    $zipname = $note_title . '.zip';
                    $zip = new ZipArchive;
                    $zip->open($zipname, ZipArchive::CREATE);
                    $zip->addFile($note_path);
                    $zip->close();

                    header('Content-Type: application/zip');
                    header('Content-disposition: attachment; filename=' . $zipname);
                    header('Content-Length: ' . filesize($zipname));
                    readfile($zipname);

                    $attached_downloaded = mysqli_query($con, "UPDATE downloads SET isattachmentdownloaded=1,attactmentdownloadeddate=NOW() WHERE noteid=$noteid AND downloader=$buyer_id");
                }*/
            }
        }
    ?>
        
        <!-- Dashboard -->
        <section id="dashboard">
        
            <div class="content-box-lg">
        
                <div class="contanier">
                    
                    <div class="row">
                        <div class="col-md-12">
                           <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Dashboard</h2>
                                </div>
                           </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4 stats text-center">
                                <h2><a href="notereview.php">
                                    <?php 
                                        $query="SELECT * FROM sellernotes WHERE status=2";
                                        $result=mysqli_query($connection,$query);
                                        echo mysqli_num_rows($result);
                                    ?>
                                </a></h2>
                                <p>Numbers of Notes in Review for Publish</p>
                            </div>
                            <div class="col-md-4 stats text-center">
                                <h2><a href="addownload.php">
                                    <?php 
                                        $userid=$_SESSION['id'];
                                        $query="SELECT * FROM downloads WHERE downloader='$userid' AND attachmentdownloadeddate > now() - INTERVAL 7 day";
                                        $result=mysqli_query($connection,$query);
                                        echo mysqli_num_rows($result);
                                    ?>
                                </a></h2>
                                <p>Numbers of New Notes Downloaded<br>(Last 7 days)</p>
                            </div>
                            <div class="col-md-4 stats text-center">
                                <h2><a href="member.php">
                                    <?php 
                                        $query="SELECT * FROM users WHERE roleid=2 AND createddate > now() - INTERVAL 7 day";
                                        $result=mysqli_query($connection,$query);
                                        echo mysqli_num_rows($result);
                                    ?>
                                </a></h2>
                                <p>Numbers of New Registrations (Last 7 days)</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
        
            </div>
        
        </section>
        <!--Notes Details End-->
        <?php
            $userid=$_SESSION['id'];
            if(isset($_GET['unpublish'])){
                $noteid=$_GET['unpublish'];
                $result=mysqli_query($connection,"UPDATE sellernotes SET status=1,modifieddate=now(),modifiedby='$userid' WHERE id='$noteid'");
            }
        ?>
        <!-- Published note -->
        <section id="publishednote">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
                        
                        <div class="col-md-12">
                           
                            <div class="col-md-12">
                               <div class="col-md-6">
                                    <div class="horizontal-heading">
                                        <h2>Published Notes</h2>
                                    </div>
                               </div>
                               <div class="col-md-6 text-right">
                                   <form action="" method="post">
                                        <img src="images/Admin_images/images/search-icon.png">
                                        <input type="text" id="search" name="search">
                                        <button class="searchbtn">search</button>
                                        <select id="month" for="month" name="month">
                                            <option value="3">Select month</option>
                                            <option value="1">Current Month</option>
                                            <option value="2">Previous 6 Month</option>
                                            <option value="3">All Posts</option>
                                        </select>
                                    </form>
                               </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="inprogress-table table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">SR NO.</th>
                                                    <th scope="col">TITLE</th>
                                                    <th scope="col">CATAGORY</th>
                                                    <th scope="col">ATTACHMENT SIZE</th>
                                                    <th scope="col">SELL TYPE</th>
                                                    <th scope="col">PRICE</th>
                                                    <th scope="col">PUBLISHER</th>
                                                    <th scope="col">PUBLISHED DATE</th>
                                                    <th scope="col">NUMBER OF<br>DOWNLOADS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php 
                                                    $userid=$_SESSION['id'];
                                                
                                                    if(isset($_POST['search'])){
                                                        $search=$_POST['search'];
                                                        $query="SELECT sn.*,u.firstname,u.lastname FROM sellernotes sn LEFT JOIN users u ON u.id=sn.sellerid ";
                                                        $query.="WHERE (u.firstname LIKE '%$search%' OR u.lastname LIKE '%$search%' OR sn.title LIKE '%$search%' OR sn.category LIKE '%$search%' OR sn.status LIKE '%$search%' OR sn.ispaid LIKE '%$search%')"; 
                                                        $query.=" AND status=3 ORDER BY sn.publisheddate";
                                                        $result=mysqli_query($connection,$query);
                                                    }else {

                                                        $query="SELECT sn.*,u.firstname,u.lastname FROM sellernotes sn LEFT JOIN users u ON u.id=sn.sellerid WHERE status=3 ORDER BY sn.publisheddate";
                                                        $result=mysqli_query($connection,$query);
                                                    }
                                                    
                                                    if(mysqli_num_rows($result)!=0){
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            $sellernoteid=$row['id'];
                                                            $date=$row['publisheddate'];
                                                            $date=date("d M Y", strtotime($date));
                                                            $title=$row['title'];
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
                                                            <td>
                                                                <?php 
                                                                    $size_result=mysqli_query($connection,"SELECT * FROM sellernotesattachment WHERE noteid=$sellernoteid");
                                                                    if(mysqli_num_rows($size_result)!=0){
                                                                        while($row=mysqli_fetch_assoc($size_result)){
                                                                            $filename=$row['filepath'];
                                                                        }
                                                                        echo round(filesize($filename)/1024) .'KB';
                                                                    }else{
                                                                        echo "10KB";
                                                                    }
                                                                ?>
                                                                
                                                            </td>
                                                            <td><?php echo $selltype; ?></td>
                                                            <td><?php echo $price; ?></td>
                                                            <td><?php echo $firstname." ".$lastname;?></td>
                                                            <td><?php echo $date; ?></td>
                                                            <td><a href="addownload.php?noteid=<?php echo $sellernoteid;?>">
                                                                <?php
                                                                    $download_query="SELECT * FROM downloads WHERE noteid=$sellernoteid";
                                                                    $download_result=mysqli_query($connection,$download_query);
                                                                    echo mysqli_num_rows($download_result);
                                                                ?>
                                                            </a></td>
                                                            <td class="dropdown">
                                                                <div id="dots" class="btn-group"><img class="dropdown-toggle" data-toggle="dropdown" style="margin-left:20px" aria-haspopup="true" aria-expanded="true" src="images/Admin_images/images/dots.png">
                                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                                                        <button class="text-left dropdown-item action-dropdown-item" type=""><a href="admindash.php?noteid=<?php echo $sellernoteid; ?>">Download Note</a></button>
                                                                        <button class="text-left dropdown-item action-dropdown-item" type=""><a href="../front/noteview.php?noteid=<?php echo $sellernoteid; ?>">View More Details</a></button>
                                                                        <button class="text-left dropdown-item action-dropdown-item" type=""><a href="admindash.php?unpublish=<?php echo $sellernoteid;?>">Unpublish</a></button>
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
        <script src="js/admindash.js"></script>
        
    </body>
</html>