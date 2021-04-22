<?php include "../includes/db.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>My Downloads</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/mydownloads.css">
        
    </head>
    
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
    
    <body>
        
        <!--Header-->
        <header>
            
            <nav class="navbar navbar-fixed-top">
               <div class="container-fluid">
                   <div class="site-nav-wrapper">

                        <div class="navbar-header">

                            <!--logo-->
                            <a href="main.html" class="navbar-brand smooth-scroll">
                                <img src="images/Front_images/images/logo.png" alt="logo" class="img-responsive">
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
                                                <a href="login.php" style="color:#6455a5;text-transform:uppercase;">Logout</a>
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
                                        <h2>My Download Notes</h2>
                                    </div>
                                </div>

                                <div class="col-md-6 text-right" style="margin-top:20px">
                                    <form action="" method="post">
                                        <img src="images/Front_images/images/search-icon.png">
                                        <input type="text" id="search" name="search">
                                        <button class="btn btn-general searchbtn" name="searchbtn" type="submit">search</button>
                                    </form>
                                </div>
                               
                            </div>
                            
                            <div class="col-md-12">
                                
                                            <?php 
                                            
                                               $userid=$_SESSION['id'];

                                                if(isset($_POST['search'])){
                                                    $search=$_POST['search'];
                                                    $query="SELECT d.*,u.emailID from downloads d LEFT JOIN users u ON u.id=d.seller ";
                                                    $query.="WHERE (d.notetitle LIKE '%$search%' OR d.notecategory LIKE '%$search%')"; 
                                                    $query.=" AND d.downloader='$userid' AND d.isattachmentdownloaded='1'";
                                                    $result=mysqli_query($connection,$query);
                                                }else {

                                                    $query="SELECT d.*,u.emailID from downloads d LEFT JOIN users u ON u.id=d.seller WHERE d.downloader='$userid' AND d.isattachmentdownloaded='1'";
                                                    $result=mysqli_query($connection,$query);
                                                }

                                                if(mysqli_num_rows($result)!=0){
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $sellernoteid=$row['noteid'];
                                                        $date=$row['attachmentdownloadeddate'];
                                                        $date=date("d M Y, G:i:s",strtotime($date));
                                                        $title=$row['notetitle'];
                                                        $category=$row['notecategory'];
                                                        $email=$row['emailID'];
                                                        $price=$row['purchasedprice'];
                                                        $paidstatus=$row['ispaid'];
                                                        static $a=1;
?>
                                                   <div class="sold-notes-table table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                   <th scope="col">SR NO.</th>
                                                                    <th scope="col">NOTE TITLE</th>
                                                                    <th scope="col">CATAGORY</th>
                                                                    <th scope="col">SELLER</th>
                                                                    <th scope="col">SELL TYPE</th>
                                                                    <th scope="col">PRICE</th>
                                                                    <th scope="col">DOWNLOAD DATE/TIME</th>
                                                                    <th scope="col">ACTION</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><?php echo $a++; ?></td>
                                                                    <td><a href="noteview.php?noteid=<?php echo $sellernoteid;?>"><?php echo $title; ?></a></td>
                                                                    <td><?php echo $category; ?></td>
                                                                    <td><?php echo $email; ?></td>
                                                                    <td><?php echo $paidstatus; ?></td>
                                                                    <td><?php echo $price; ?></td>
                                                                    <td><?php echo $date; ?></td>
                                                                    <td class="dropdown">
                                                                        <a class="link-margin" href="noteview.php?noteid=<?php echo $sellernoteid;?>"><img src="images/Front_images/images/eye.png"></a>
                                                                        <div id="dots" class="btn-group"><img class="dropdown-toggle" data-toggle="dropdown" style="margin-left:20px" aria-haspopup="true" aria-expanded="true" src="images/Front_images/images/dots.png">
                                                                            <div class="dropcontent dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                                                                <button><a href="mydownloads.php?noteid=<?php echo $sellernoteid; ?>">
                                                                                <h6 class="dropdown-first-option">Download Note</h6>
                                                                                </a></button><!--
                                                                                <button class="text-left dropdown-item action-dropdown-item" type="">Download Note</button>-->
                                                                                <button><a role="button" data-id="<?php echo $sellernoteid; ?>"
                                                                                id="add-review-star" data-toggle="modal"
                                                                                data-target="#add-review-popup">
                                                                                <h6>Add Review/feedback</h6>
                                                                                </a></button>
                                                                                <!--<button class="text-left dropdown-item action-dropdown-item" type="" id="reivewbtn" href='mydownloads.php?noteid=<?php /*echo $sellernoteid;*/ ?>'>Add Reviews/Feedback</button>-->
                                                                                <button><a role="button" data-toggle="modal"
                                                                                data-title="<?php /*echo $notetitle;*/ ?>"
                                                                                data-noteid="<?php echo $sellernoteid ?>"
                                                                                data-seller_id="<?php/* echo $seller_id*/ ?>"
                                                                                data-target="#mark-as-inappropriate" id="inappropriate">
                                                                                <h6 class="report-my-downloads">Report as inappropriate</h6>
                                                                                    </a></button>
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
                            
                            <?php 
                            
                                $userid = $_SESSION['id'];
                            
                                if(isset($_POST['submit_review'])){
                                    
                                    $comment=$_POST['cmnt_review'];
                                    $noteid=$_POST['noteid_for_review'];
                                    $starVal=$_POST['starVal'];
                                    
                                    $query="INSERT into sellernotesview (noteid,reviewedbyid,ratings,comments,createdby,createddate,isactive) ";
                                    $query.="VALUES ('$noteid','$userid','$starVal','$comment',$userid,now(),1)";
                                    
                                    $result=mysqli_query($connection,$query);
                                }
                            
                                
                            
                            ?>
                            
                            <!--<div id="review-dialogbox">
                               <div id="review-content">
                                   
                                    <form action="mydownloads.php" method="post">
                                        <h4>Add Review</h4><span class="close"><img src="images/Front_images/images/close-icon.svg"></span><br>
                                        <img class="star" src="images/Front_images/images/star-white.png">
                                        <img src="images/Front_images/images/star-white.png">
                                        <img src="images/Front_images/images/star-white.png">
                                        <img src="images/Front_images/images/star-white.png">
                                        <img src="images/Front_images/images/star-white.png"><br>
                                        <label for="comments">Comments &#42;</label><br>
                                        <textarea placeholder="Comments..." name="comments" cols="30" rows="10"></textarea>
                                        <button type="submit" class="btn btn-general" name="submitbtn" id="submitbtn">Submit</button>
                                    </form>
                                   
                               </div>
                                
                            </div>-->
                            
                            <!-- Add review Pop up -->
        <div class="review-box">
            <div style="margin-top: 120px;" id="add-review-popup" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <button type="button" class="close text-right popup-close-btn" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <h4>Add Review</h4>
                                <div id="review-popup-rating"></div>
                                <div class="form-group">
                                    <label id="review-label">Comments *</label>
                                    <textarea id="review-comment-box" name="cmnt_review" placeholder="Comments..."
                                        class="form-control" required></textarea>
                                    <input name="starVal" id="starVal" type="hidden">
                                    <input name="noteid_for_review" id="noteid_for_review" type="hidden">
                                </div>
                                <button id="review-popup-btn" type="submit" name="submit_review"
                                    class="btn btn-primary blue-button-hover-white">submit</button>
                                <button class="btn btn-primary blue-button-hover-white btn-upper">cancel</button>
                                <h6 class="one-time-only">(you can review it only once!)</h6>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                           
                           
                           <!-- Mark as an inapropriate Pop up -->
        <div class="review-box">
            <div style="margin-top: 120px;" id="mark-as-inappropriate" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <button type="button" class="close text-right popup-close-btn" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <h4 id="title_for_inappropriate" class="blue-font-26"></h4>
                                <div class="form-group">
                                    <label id="review-label2">Remarks *</label>
                                    <textarea id="review-comment-box2" name="inappropriate_review"
                                        placeholder="Remarks..." class="form-control" required></textarea>
                                </div>
                                    <input id="note_id_inappropriate" name="inappropriate_noteid" type="hidden"><!--
                                    <input id="note_seller_inappropriate" name="inappropriate_seller" type="hidden">-->
                                <button id="review-popup-btn2" type="submit" name="inappropriate_submit"
                                    class="btn red-button-hover-white">Report</button>
                                <button class="btn btn-primary blue-button-hover-white btn-upper">cancel</button>
                                <h6 class="one-time-only">(you can review it only once!)</h6>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                            
                            <?
                            
                                $userid = $_SESSION['id'];
                            
                                if(isset($_POST['inappropriate_submit'])){
                                    
                                    $remarks=$_POST['remarks'];
                                    $noteid=$_POST['inappropriate_noteid'];
                                    
                                    $query="INSERT INTO sellernotesreport (noteid,reportedbyid,remarks,createdby,createddate,isactive) ";
                                    $query.="VALUES ('$noteid',$userid','$remarks',$userid,now(),1)";
                                    
                                    $result=mysqli_query($connection,$query);
                                }
                            
                            
                            ?>
                            
                            <!--<div id="report-dialogbox">
                               <div id="report-content">
                                   
                                    <form action="mydownloads.php" method="post">
                                        <label for="notetitle">Notes-Title</label><br>
                                        <input type="text" name="notetitle" value="<?php /*echo $title; */?>" readonly><br>
                                        <label for="remarks">Remarks</label><br>
                                        <textarea placeholder="Remarks.." name="remarks" cols="30" rows="10"></textarea><br>
                                        <button type="submit" class="btn btn-general" name="submitbutton">Submit</button>
                                        <button type="" class="btn btn-general" name="cancelbtn">Cancel</button>
                                    </form>
                                   
                               </div>
                                
                            </div>-->
                            
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
        
        <!--Rapstar-->
        <script src="js/jsRapStar.js"></script>
        <script>
    $("#review-popup-rating").jsRapStar({
        step: false,
        value: 0,
        length: 5,
        starHeight: 64,
        colorFront: '#d8d8d8',
        onClick: function(score) {
            this.StarF.css({
                color: '#ffff00',
                'text-shadow': '0 0 10px #13a2d1'
            });
            $("#starVal").val(score);
        },
        onMousemove: function(score) {
            $(this).attr('title', 'Rate ' + score);
        }
    });

    $(function() {

        //note id getter via data id
        $(document).on("click", "#add-review-star", function() {
            $('#noteid_for_review').val($(this).data('id'));
            $('#add-review-popup').modal('show');
        });

        //note title getter via data id
        $(document).on("click", "#inappropriate", function() {
            $("#title_for_inappropriate").text($(this).data('title'));
            $("#note_id_inappropriate").val($(this).data('noteid'));
            $("#note_seller_inappropriate").val($(this).data('seller_id'));
            $("#mark-as-inappropriate").modal('show');
        })

        /*//table resicer for less entries
        $('#myTable').on('show.bs.dropdown', function() {
            $('#myTable').css("min-height", "135px");
        });

        $('#myTable').on('hide.bs.dropdown', function() {
            $('#myTable').css("min-height", "0");
        });*/
    });
    </script>
        
        <!--Bootstrap JS-->
        <script src="js/bootstrap/bootstrap.min.js"></script>
        
        <!--Owl carousel-->
        <script src="js/owl-carousel/owl.carousel.min.js"></script>
        
        <!--custom JS-->
        <script src="js/mydownloads.js"></script>
        
    </body>
</html>