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
        
        <title>Buyer Request</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/buyerreq.css">
        
    </head>
    
    <body>
        
        <!--Header-->
        <header>
            
            <nav class="navbar navbar-fixed-top">
               <div class="container-fluid">
                   <div class="site-nav-wrapper">

                        <div class="navbar-header">

                            <!--logo-->
                            <a href="main.html" class="navbar-brand smooth-scroll">
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
                                                <a href="login.php" style="color:#6255a5;text-transform:uppercase;">Logout</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="smooth-scroll" href="logout.php"><button id=logoutbtn>Logout</button></a></li>
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
            
            if(isset($_GET['downloadid'])){
                $downloadid=$_GET['downloadid'];
                $buyerid=$_GET['buyerid'];
                $query="UPDATE downloads SET issellerhasalloweddownload=1 WHERE id='$downloadid'";
                $result=mysqli_query($connection,$query);
                
                $buyer_result=mysqli_query($connection,"SELECT * FROM users WHERE id='$buyerid'");
                while($row=mysqli_fetch_assoc($buyer_result)){
                    $firstname=$row['firstname'];
                    $lastname=$row['lastname'];
                    $email=$row['emailID'];
                }
                $seller_result=mysqli_query($connection,"SELECT firstname FROM users WHERE id='$userid'");
                while($row=mysqli_fetch_assoc($seller_result)){
                    $sellername=$row['firstname'];
                }
                
                
                if(!empty($downloadid) && !empty($buyerid)){

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


                        $mail->addAddress($email, 'NotesMarketPlace Admin');  // This email is where you want to send the email
                        $mail->addReplyTo($config_email, 'Sender name');   // If receiver replies to the email, it will be sent to this email address

                        // Setting the email content
                        $mail->IsHTML(true);  // You can set it to false if you want to send raw text in the body
                        $mail->Subject = "$sellername Allows you to download a note";       //subject line of email
                        $mail->Body = "<p>Hello$firstname,</p><br><br><p>We would like to inform you that,$sellername Allows you to download a note. Please login and see My Download tabs to download particular note.</p><br><p>Regards,</p><br>";   //Email body
                        $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email

                        $mail->send();
                        $email_sent= "Thank You For Contacting us! We will try to resolve your issue as soon as posibble!";
                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
                
            }
            
        ?>
        
        <!-- Inprogress Note -->
        <section id="buyerrequest">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
                        
                        <div class="col-md-12">
                           
                            <div class="col-md-12">
                               <div class="col-md-6">
                                    <div class="horizontal-heading">
                                        <h2>Buyer Requests</h2>
                                    </div>
                               </div>
                               <div class="col-md-6 text-right" style="margin-top:20px">
                                   <form action="" method="post">
                                       <img src="images/Front_images/images/search-icon.png">
                                        <input type="text" id="search" name="search">
                                        <button class="searchbtn">search</button>
                                    </form>
                               </div>
                            </div>
                            
                            <div class="col-md-12 note">
                                
                                
                                    
                                        
                                           <?php 
                                            
                                                $userid=$_SESSION['id'];
                                            
                                                if(isset($_POST['search'])){
                                                    $search=$_POST['search'];
                                                    $query="SELECT d.*,u.firstname,u.lastname,up.phoneno,up.phoncountry from downloads d LEFT JOIN users u ON u.id=d.downloader LEFT JOIN userprofile up ON u.id=up.userid ";
                                                    $query.="WHERE (u.firstname LIKE '%$search%' OR u.lastname LIKE '%$search%' OR d.notetitle LIKE '%$search%' OR d.notecategory LIKE '%$search%' OR d.ispaid LIKE '%$search%')"; 
                                                    $query.=" AND d.seller='$userid'";
                                                    $result=mysqli_query($connection,$query);
                                                }else {

                                                    $query="SELECT d.*,u.firstname,u.lastname,up.phoneno,up.phoncountry from downloads d LEFT JOIN users u ON u.id=d.downloader LEFT JOIN userprofile up ON u.id=up.userid WHERE d.seller='$userid'";
                                                    $result=mysqli_query($connection,$query);
                                                }

                                                if(mysqli_num_rows($result)!=0){
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $sellernoteid=$row['noteid'];
                                                        $date=$row['modifieddate'];
                                                        $date=date("d M Y,G:i:s",strtotime($date));
                                                        $title=$row['notetitle'];
                                                        $category=$row['notecategory'];
                                                        $price=$row['purchasedprice'];
                                                        $buyerid=$row['downloader'];
                                                        $phone=$row['phoneno'];
                                                        $countrycode=$row['phoncountry'];
                                                        $paidstatus=$row['ispaid'];
                                                        $firstname=$row['firstname'];
                                                        $lastname=$row['lastname'];
                                                        $downloadid=$row['id'];
                                                        static $a=1;
?>
                                                 <div class="buyer-request-table table-responsive">
                                                  <table class="table">
                                                   <thead>
                                                        <tr>
                                                           <th scope="col">SR NO.</th>
                                                            <th scope="col">NOTE TITLE</th>
                                                            <th scope="col">CATAGORY</th>
                                                            <th scope="col">BUYER</th>
                                                            <th scope="col">PHONE NO.</th>
                                                            <th scope="col">SELL TYPE</th>
                                                            <th scope="col">PRICE</th>
                                                            <th scope="col">DOWNLOAD DATE/TIME</th>
                                                            <th scope="col">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><?php echo $a++; ?></td>
                                                        <td><a href="noteview.php?noteid=<?php echo $sellernoteid;?>"><?php echo $title;?></a></td>
                                                        <td><?php echo $category; ?></td>
                                                        <td><?php echo $firstname." ".$lastname;?></td>
                                                        <td><?php if($phone!=null){echo "+";}$countrycode.$phone;?></td>
                                                        <td><?php echo $paidstatus; ?></td>
                                                        <td><?php echo $price;?></td>
                                                        <td><?php echo $date;?></td>
                                                        <td class="dropdown">
                                                            <a class="link-margin" href="noteview.php?noteid=<?php echo $sellernoteid; ?>"><img src="images/Front_images/images/eye.png"></a>
                                                            <div id="dots" class="btn-group"><img class="dropdown-toggle" data-toggle="dropdown" style="margin-left:20px" aria-haspopup="true" aria-expanded="true" src="images/Front_images/images/dots.png">
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                                                    <button class="text-left dropdown-item action-dropdown-item" id="downloadbtn" name="allow-download"><a href="buyerreq.php?downloadid=<?php echo $downloadid;?>&buyerid=<?php echo $buyerid; ?>">Allow Download</a></button>
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
        
    </body>
    
    <!--Jquery-->
        <script src="js/jquery.js"></script>
        
        <!--Bootstrap JS-->
        <script src="js/bootstrap/bootstrap.min.js"></script>
        
        <!--Owl carousel-->
        <script src="js/owl-carousel/owl.carousel.min.js"></script>
        
        <!--Counter-->
        <script src="js/counter/jquery.counterup.min.js"></script> 
        
        <!--custom JS-->
        <script src="js/buyerreq.js"></script>
    
</html>