<?php include "../includes/db.php"; ?>
<?php session_start();?>
<!DOCTYPE html>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    //include PHPMailer classes to your PHP file for sending email
    require_once __DIR__ . '/src/Exception.php';
    require_once __DIR__ . '/src/PHPMailer.php';
    require_once __DIR__ . '/src/SMTP.php';
?>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Contact Us</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/contact.css">
        
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
                                    <?php
                                        if($_SESSION==null){
                                           echo "<li><a class='smooth-scroll' href='login.php'><button id=loginbtn>Sell Your Notes</button></a></li>"; 
                                        }else{
                                            echo "<li><a class='smooth-scroll' href='dashboard.php'>Sell Your Notes</button></a></li>"; 
                                        }
                                    ?>
                                    <li><a class="smooth-scroll" href="faq.php">FAQ</a></li>
                                    <li><a class="smooth-scroll" href="contact.php">Contact Us</a></li>
                                    <?php
                                        if($_SESSION==null){
                                           echo "<li><a class='smooth-scroll' href='login.php'><button id=loginbtn>Login</button></a></li>"; 
                                        }else{
                                            $userid= $_SESSION['id'];
                                            $query="SELECT * From userprofile WHERE userid='$userid'";
                                            $result=mysqli_query($connection,$query);
                                            if($row=mysqli_fetch_assoc($result)){
                                                $profilepicture=$row['profilepic'];
                                            }
                                            echo "<li>";
                                            echo "<div class='dropdown'>";
                                            echo "<input type='image' style='border-radius:50%;' src='../uploaded/$profilepicture' class='smooth-scroll dropbtn img-responsive' onclick='myFunction()'>";
                                            echo "<div id='myDropdown' class='dropdown-content'>";
                                            echo "<a href='userprofile.php'>Update Profile</a>";
                                            echo "<a href='mydownloads.php'>My Downloads</a>";
                                            echo "<a href='mysoldnotes.php'>My Sold Notes</a>";
                                            echo "<a href='myrejectednotes.php'>My Rejected Notes</a>";
                                            echo "<a href='cpass.php'>Change Password</a>";
                                            echo "<a href='login.php'>Logout</a>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</li>";
                                            echo "<li><a class='smooth-scroll' href='logout.php'><button onclick='return confirm('Are you sure, you want to logout?');' id=logoutbtn>Logout</button></a></li>";
                                        }
                                    ?>
                                    <?php
                                        if(isset($_POST['submit'])){
                                            $name = $_POST['fullname'];
                                            $user_email = $_POST['email'];
                                            $subject = $_POST['subject'];
                                            $comments = $_POST['comment'];

                                            if(preg_match('/[0-9]/', $name)){
                                            $text_only_error_firstname = "Numeric Value is not allowed !";
                                            }
                                            else if(!preg_match('/[0-9]/', $name) && !empty($user_email) && !empty($subject) && !empty($comments)){

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


                                                    $mail->addAddress('akshargothi9876@gmail.com', 'NotesMarketPlace Admin');  // This email is where you want to send the email
                                                    $mail->addReplyTo($config_email, 'Sender name');   // If receiver replies to the email, it will be sent to this email address

                                                    // Setting the email content
                                                    $mail->IsHTML(true);  // You can set it to false if you want to send raw text in the body
                                                    $mail->Subject = "$name -Query";       //subject line of email
                                                    $mail->Body = "<p>Hello,</p><br><br><p>$comments</p><br><p>Regards,</p><br><p>$name</p>";   //Email body
                                                    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email

                                                    $mail->send();
                                                    $email_sent= "Thank You For Contacting us! We will try to resolve your issue as soon as posibble!";
                                                } catch (Exception $e) {
                                                    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                                                }
                                                }
                                        }
                                   ?>
                                    
                                </ul>
                            </div>
                        </div>
                        <!--main menu end-->
                    </div>
               </div>
                
            </nav>
            
        </header>
        <!--Header End-->
        
        <!--Contact BG-->
        <section id="contactbackground">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                           <div id="contactbg">
                               <h2>Contact Us</h2>
                           </div>
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Contact BG End-->
        
        <!--Contact Us-->
        <section id="contactus">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <h2>Get in Touch</h2>
                                <h5>Let us know to get back to you</h5>
                            </div>
                        </div>
        
                    </div>
                    
                    <div class="row">
        
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <form action="contact.php" method="post">
                                    <label for="fullname">Full name &#42;</label><br>
                                    <input type="text" id="funame" name="fullname">
                                    <label for="email">Email Address &#42;</label><br>
                                    <input type="email" id="email" name="email">
                                    <label class="la" for="subject">Subject &#42;</label><br>
                                    <input type="text" id="subject" name="subject">
                                    <label for="comment">Comments/Questions &#42;</label><br>
                                    <textarea id="comment" name="comment" rows="10" cols="50"></textarea>
                                    <button id="submitbtn" name="submit" value="submit">Submit</button>
                                </form>
                            </div>
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Contact Us End-->
        
        <!--Footer-->
        <footer>
            <div class="content-box-lg">

                <div class="contanier">

                    <div class="row">

                        <div class="col-md-6 text-left" id="copytext">
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
            
        </footer>
        <!--Footer End-->
        
    </body>
    
    <!--Jquery-->
    <script src="js/jquery.js"></script>

    <!--Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!--Owl carousel-->
    <script src="js/owl-carousel/owl.carousel.min.js"></script>

    <!--custom JS-->
    <script src="js/contact.js"></script>
    
</html>