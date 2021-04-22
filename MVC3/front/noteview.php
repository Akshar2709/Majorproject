<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    //include PHPMailer classes to your PHP file for sending email
    require_once __DIR__ . '/src/Exception.php';
    require_once __DIR__ . '/src/PHPMailer.php';
    require_once __DIR__ . '/src/SMTP.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Note Preview</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Rapstar-->
        <link rel="stylesheet" href="css/jsRapStarSmall.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/noteview.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <header>
            
            <nav class="navbar navbar-fixed-top">
               <div class="container-fluid">
                   <div class="site-nav-wrapper">

                        <div class="navbar-header">

                            <!--logo-->
                            <a href="main.php" class="navbar-brand smooth-scroll">
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
                                                <a href="login.php">Logout</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="smooth-scroll" href="logout.php"><button id=loginbtn>Logout</button></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--main menu end-->
                    </div>
               </div>
                
            </nav>
            
        </header>
        <!--Header End-->
    <?php
        
        if(isset($_POST['downloadbtn'])){
            $buyerid=$_SESSION['id'];
            $noteid=$_POST['sellernoteid'];
            $sellerid=$_POST['sellerid'];
            $paidstatus=$_POST['paidstatus'];
            $attachmentpath=$_POST['attachmentpath'];
            $title=$_POST['title'];
            $category=$_POST['category'];
            $price=$_POST['price'];
            $query="SELECT * FROM downloads WHERE noteid=$noteid";
            $result=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($result)){
                $isallow=$row['issellerhasalloweddownload'];
            }
            if($buyerid!=$sellerid && $paidstatus=='paid'){
                
                if($isallow=='1'){
                
                    $download_query = mysqli_query($connection, "SELECT notetitle,attachmentpath FROM downloads WHERE noteid='$noteid' AND downloader='$buyerid'");
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

                            $attached_downloaded = mysqli_query($connection, "UPDATE downloads SET isattachmentdownloaded=1,attachmentdownloadeddate=NOW() WHERE noteid=$noteid AND downloader=$buyerid");
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
                
                }else{

                    $query_download_insert="INSERT INTO downloads (noteid,seller,attachmentpath,notetitle,notecategory,ispaid,purchasedprice,createddate,createdby,isactive) "; $query_download_insert.="VALUES('$noteid','$sellerid','$attachmentpath','$title','$category','$paidstatus','$price',now(),'$userid',1)";
                    $result_download_insert=mysqli_query($connection,$query_download_insert);
                    $insertid=mysqli_insert_id($connection);

                    $query="UPDATE downloads SET downloader='$buyerid',modifieddate=now(),modifiedby='$buyerid' WHERE id='$insertid'";
                    $result=mysqli_query($connection,$query);
                    header("location:dashboard.php");
                    
                    $buyer_result=mysqli_query($connection,"SELECT * FROM users id='$buyerid'");
                    while($row=mysqli_fetch_assoc($buyer_result)){
                        $buyername=$row['firstname'];
                    }
                    
                    $seller_result=mysqli_query($connection,"SELECT * FROM users id='$sellerid'");
                    while($row=mysqli_fetch_assoc($seller_result)){
                        $sellername=$row['firstname'];
                        $selleremail=$row['emailID'];
                    }
                    
                    if(!empty($sellerid) && !empty($buyerid)){

                       $mail = new PHPMailer(true);

                        try {
                            // Server settings
                            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;        // You can enable this for detailed debug output
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587;  // This is fixed port for gmail SMTP

                            $config_email = 'akshargothi9876@gmail.com';
                            $mail->Username = $config_email; // YOUR gmail email which will be used as sender and PHPMailer configuration 
                            $mail->Password = 'aksharswami123';   // YOUR gmail password for above account

                            // Sender and recipient settings
                            $mail->setFrom($config_email, 'NotesMarketPlace');  // This email address and name will be visible as sender of email


                            $mail->addAddress($selleremail, 'NotesMarketPlace Admin');  // This email is where you want to send the email
                            $mail->addReplyTo($config_email, 'Sender name');   // If receiver replies to the email, it will be sent to this email address

                            // Setting the email content
                            $mail->IsHTML(true);  // You can set it to false if you want to send raw text in the body
                            $mail->Subject = "$buyername wants to purchase your notes";       //subject line of email
                            $mail->Body = "<p>Hello$sellername,</p><br><br><p>We would like to inform you that, $buyername wants to purchase your notes. Please see Buyer Requests tab and allow download access to Buyer if you have received the payment from him.</p><br><p>Regards,<br>Notes Marketplace</p><br>";   //Email body
                            $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email

                            $mail->send();
                            $email_sent= "Thank You For Contacting us! We will try to resolve your issue as soon as posibble!";
                        } catch (Exception $e) {
                            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                        }
                    }
                    
                    

                }
                
                
            }elseif($buyerid!=$sellerid && $paidstatus=='free'){
                
                $query_download_insert="INSERT INTO downloads (noteid,seller,issellerhasalloweddownload,attachmentpath,notetitle,notecategory,ispaid,purchasedprice,createddate,createdby,isactive) "; $query_download_insert.="VALUES('$noteid','$sellerid',1,'$attachmentpath','$title','$category','$paidstatus','$price',now(),'$userid',1)";
                $result_download_insert=mysqli_query($connection,$query_download_insert);
                $insertid=mysqli_insert_id($connection);

                $query="UPDATE downloads SET downloader='$buyerid',modifieddate=now(),modifiedby='$buyerid' WHERE id='$insertid'";
                $result=mysqli_query($connection,$query);
                
                $download_query = mysqli_query($connection, "SELECT notetitle,attachmentpath FROM downloads WHERE noteid='$noteid' AND downloader='$buyerid'");
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

                        $attached_downloaded = mysqli_query($connection, "UPDATE downloads SET isattachmentdownloaded=1,attachmentdownloadeddate=NOW() WHERE noteid=$noteid AND downloader=$buyerid");
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
                
            }else{
                
                $query_download_insert="INSERT INTO downloads (noteid,seller,issellerhasalloweddownload,attachmentpath,notetitle,notecategory,ispaid,purchasedprice,createddate,createdby,isactive) "; $query_download_insert.="VALUES('$noteid','$sellerid',1,'$attachmentpath','$title','$category','$paidstatus','$price',now(),'$userid',1)";
                $result_download_insert=mysqli_query($connection,$query_download_insert);
                $insertid=mysqli_insert_id($connection);

                $query="UPDATE downloads SET downloader='$buyerid',modifieddate=now(),modifiedby='$buyerid' WHERE id='$insertid'";
                $result=mysqli_query($connection,$query);
                
                $download_query = mysqli_query($connection, "SELECT notetitle,attachmentpath FROM downloads WHERE noteid='$noteid' AND downloader='$buyerid'");
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

                        $attached_downloaded = mysqli_query($connection, "UPDATE downloads SET isattachmentdownloaded=1,attachmentdownloadeddate=NOW() WHERE noteid=$noteid AND downloader=$buyerid");
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
            
            
        }
    ?>
        
        <!-- Note Details -->
        <section id="notedetails">
        
            <div class="content-box-lg">
        
                <div class="contanier">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <h2>Note Details</h2>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                    
                        <?php 
                            
                            if(isset($_GET['noteid'])){
                                
                                $noteid=$_GET['noteid'];
                                $userid=$_SESSION['id'];

                                $query="SELECT * from sellernotes WHERE id='$noteid'";
                                $result=mysqli_query($connection,$query);

                                while($row = mysqli_fetch_assoc($result)){
                                    $sellernoteid=$row['id'];
                                    $date=$row['publisheddate'];
                                    $title=$row['title'];
                                    $displaypicture=$row['displaypic'];
                                    $category=$row['category'];
                                    $price=$row['sellingprice'];
                                    $paidstatus=$row['ispaid'];
                                    $pages=$row['noofpage'];
                                    $description=$row['description'];
                                    $university=$row['university'];
                                    $country=$row['country'];
                                    $course=$row['course'];
                                    $coursecode=$row['coursecode'];
                                    $professor=$row['professor'];
                                    
                                    
                                    $result=mysqli_query($connection,"SELECT sn.sellerid,sna.filepath FROM sellernotes sn LEFT JOIN sellernotesattachment sna ON sna.noteid=sn.id WHERE sn.id='$sellernoteid'");
                                    while($row=mysqli_fetch_assoc($result)){
                                        $sellerid=$row['sellerid'];
                                        $attachmentpath=$row['filepath'];
                                    }
                                    
                                    
?>
                                    <div class="col-md-6">
                                    <div class='col-md-5'>
                                    <img style='height:280px;width:280px;' src='<?php echo $displaypicture;?>'>
                                    </div>
                                    <div class='col-md-7 text-left'>
                                    <h2><?php echo $title;?></h2>
                                    <h6><?php echo $category;?></h6>
                                    <p><?php echo $description;?></p>
                                    <form action="" method="post">
                                    <input type="number" value="<?php echo $sellernoteid; ?>" name="sellernoteid" hidden>
                                    <input type="number" value="<?php echo $sellerid; ?>" name="sellerid" hidden>
                                    <input type="type" value="<?php echo $attachmentpath; ?>" name="attachmentpath" hidden>
                                    <input type="type" value="<?php echo $title; ?>" name="title" hidden>
                                    <input type="type" value="<?php echo $category; ?>" name="category" hidden>
                                    <input type="number" value="<?php echo $price; ?>" name="price" hidden>
                                    <input type="type" value="<?php echo $paidstatus; ?>" name="paidstatus" hidden>
                                    <button id="downloadbtn" name="downloadbtn" onclick="return confirm('Are you sure you want to download this Paid note. Please confirm.');">download<?php if($paidstatus=='paid'){ echo "/&#36;".$price;}?></button>
                                    </form>
                                    </div>
                                    </div>

                                    <div class="col-md-6">
                                    <div class="col-md-6">
                                    <p>Institution:</p>
                                    </div>
                                    <div class="col-md-6 text-right info">
                                    <p><?php echo $university;?></p>
                                    </div>
                                    <div class="col-md-6">
                                    <p>Country:</p>
                                    </div>
                                    <div class="col-md-6 text-right info">
                                    <p><?php echo $country;?></p>
                                    </div>
                                    <div class="col-md-6">
                                    <p>Course Name:</p>
                                    </div>
                                    <div class="col-md-6 text-right info">
                                    <p><?php echo $course;?></p>
                                    </div>
                                    <div class="col-md-6">
                                    <p>Course Code:</p>
                                    </div>
                                    <div class="col-md-6 text-right info">
                                    <p><?php echo $coursecode;?></p>
                                    </div>
                                    <div class="col-md-6">
                                    <p>Professor:</p>
                                    </div>
                                    <div class="col-md-6 text-right info">
                                    <p><?php echo $professor;?></p>
                                    </div>
                                    <div class="col-md-6">
                                    <p>Number of Pages:</p>
                                    </div>
                                    <div class="col-md-6 text-right info">
                                    <p><?php echo $pages;?></p>
                                    </div>
                                    <div class="col-md-6">
                                    <p>Approval Date:</p>
                                    </div>
                                    <div class="col-md-6 text-right info">
                                    <p><?php echo $date;?></p>
                                    </div>
                                    <div class="col-md-6">
                                    <p>Rating:</p>
                                    </div>
                                    <div class="col-md-6 text-right info">
                                    <div id="stars">
                                    <div class="col-md-6">
                                    <?php
                                        $star_rating = mysqli_query($connection, "SELECT AVG(ratings),COUNT(ratings) FROM sellernotesview WHERE noteid=$noteid");
                                        while ($row = mysqli_fetch_assoc($star_rating)) {
                                            $star_rating_val = $row['AVG(ratings)'];
                                            $star_rating_count = $row['COUNT(ratings)'];
                                        }if ($star_rating_count > 0) { ?>
                                        <div class="rating-merger">
                                            <div id="review_star"></div>
                                        </div>
                                        <?php  } else { ?>
                                        <div>
                                            <h3>No ratings Yet!</h3>
                                        </div>
                                        <?php   }
                                    ?>
                                    </div>
                                    <div class="col-md-6 info">
                                    <p>
                                        <?php echo $star_rating_count; ?> Reviews
                                    </p>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6" id="notice">
                                    <p><?php
                                            $report_result=mysqli_query($connection,"SELECT * FROM sellernotesreport WHERE noteid=$sellernoteid");
                                            echo mysqli_num_rows($report_result);
                                        ?> users marked this note as in appropriate</p>
                                    </div>
                                    </div>
<?php
                                }
                                
                            }
                             
                        ?>
                        
                        
                    <!---->
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Notes Details End-->
        
        <!-- Notes Preview -->
        <section id="notespreview">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
                        
                        <div class="col-md-5">
                           
                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Note Preview</h2>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                
                                <div id="preview">
                               
                                    <div class="col-md-12 text-center" id="notepage">
                                        <h4>1/ 13</h4>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <h4>Unit-1</h4>
                                        <p>16 Marks Questions and Answers</p>
                                    </div>

                                    <div class="col-md-12 ques">
                                        <h6>1. Explain briefly about characteristics of GUI?</h6>
                                        <p>Sophisticated Visual Presentation</p>
                                        <p>Pick and Click Interaction</p>
                                        <p>Restricted set of interface options</p>
                                        <p>Visualization</p>
                                        <p>Object orientation</p>
                                        <p>Properties or attributes of Objects</p>
                                        <p>Actions</p>
                                        <p>Application versus object or Data orientation</p>
                                        <p>Views</p>
                                        <p>Use of recognition memory</p>
                                        <p>Concurrent performance of function</p>
                                    </div>

                                    <div class="col-md-12 ques">
                                        <h6>2. Explain briefly about characteristics of GUI?</h6>
                                        <p>Advantages:</p>
                                    </div>
                                
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <!--Reviews-->
                        <div class="col-md-7">
                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Customer Reviews</h2>
                                </div>
                            </div>
                            
                                <div class="col-md-12">
                                 
                                    <div id="reviews">
                                        <!--reviewer 1-->
                                        <?php
                                        
                                            $query="SELECT *  FROM sellernotesview sn LEFT JOIN userprofile up ON sn.reviewedbyid=up.userid LEFT JOIN users u ON u.id=up.userid WHERE noteid='$noteid' LIMIT 3";
                                            $result=mysqli_query($connection,$query);
                                            $count=mysqli_num_rows($result);
                                            if($count!=0){
                                                while($row=mysqli_fetch_assoc($result)){
                                                    $comments=$row['comments'];
                                                    $profilepic=$row['profilepic'];
                                                    $firstname=$row['firstname'];
                                                    $lastname=$row['lastname'];
                                                    $star_rating_val=$row['ratings'];
                                                ?>
                                                
                                        <div class="col-md-1">
                                            <div class="reviewerimg">
                                                <img style="border-radius:50%;" src="<?php if($count!=0)echo $profilepic; ?>">   
                                           </div>
                                        </div>

                                        <div class="col-md-11">
                                           <div class="reviewercont">
                                               <h2><?php echo $firstname." ".$lastname ?></h2>
                                                    <div class="rating-merger">
                                                        <div id="review_star"></div>
                                                    </div>
                                                <p><?php echo $comments; ?></p>
                                           </div>
                                        </div>
                                        <?php }
                                            }else{
                                                echo "<h2 class='text-center' style='color:#6255a5;'>No Record</h2>";
                                            }
                                        
                                        ?>
                                    </div>
                                  
                                </div>  
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Note Preview End-->
        
        <footer>
            <!--Footer-->
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
        
    </body>
    
    <!--Rapstar-->
    <script src="js/jsRapStar.js"></script>
    
    <script>
    $('#review_star').jsRapStar({
        length: 5,
        starHeight: 30,
        colorFront: 'yellow',
        enabled: false,
        value: '<?php echo $star_rating_val ?>',
    });
    </script>
    
    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    
    <!--Custom JS-->
    <script src="js/noteview.js"></script>
    
</html>