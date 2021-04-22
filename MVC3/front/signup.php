<?php include "../includes/db.php"; ?>
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
<html>
   
    <head>
       
        <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Create Account</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/signup.css">
        
    </head>
    
    <body>
        
        <!--Login Page-->
        <section id="signup">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
                       
                       <div class="col-md-12 text-center">
                           <!--logo-->
                            <a href="#" class="navbar-brand smooth-scroll logo">
                                <img src="images/Front_images/images/logo.png" alt="logo" class="img-responsive">
                            </a>
                       </div>
                       
                    </div>
                    
                    <div class="row">
                        <div id="signuppart">
                           
                            <div class="col-md-12 text-center">
                                <h2>Create Account</h2>
                                <p>Enter your details to signup</p>
                            </div>
                            
<?php    
if(isset($_POST['signupbtn'])){
    
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $password=$_POST['password1'];
    
    $firstname=mysqli_real_escape_string($connection,$firstname);
    $lastname=mysqli_real_escape_string($connection,$lastname);
    $email=mysqli_real_escape_string($connection,$email);
    $password=mysqli_real_escape_string($connection,$password);
    
            
            $hashformat="$2y$10$";
            $salt="iusesomecrazystrings22";
            $hashsalt=$hashformat.$salt;
            $password=crypt($password,$hashsalt);

            if(preg_match('/[0-9]/', $firstname)){
                $text_only_error_firstname = "Numeric Value is not allowed !";
            }
            else if(!preg_match('/[0-9]/', $firstname) && !empty($email) && !empty($lastname)){

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
                    $mail->Subject = "$firstname.$lastname -Query";       //subject line of email
                    $mail->Body = "<p>Thank you for Signup.<br><br> Please verify the email address via clicking on the link we sent you via email.</p><br><br><p>http://localhost/notemarketplace/front/emailverification.php?fname=$firstname&lname=$lastname&email=$email&password=$password</p><br><p>Regards,</p><br><p>$firstname</p>";   //Email body
                    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email

                    $mail->send();
                    $email_sent= "Thank You For Contacting us! We will try to resolve your issue as soon as posibble!";
                } catch (Exception $e) {
                    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                }
            }

    header("location:login.php");
    
}
?>
                            <div class="col-md-12">
                               <!--<i class='fa fa-green'></i><p id='successnote' class='text-center'>Email is sent.Please verify it.</p>-->
                                <form class="form-group" name="signupform" method="post" action="signup.php" onsubmit="return validateform()">
                                    <label for="firstname">Firstname &#42;</label><br>
                                    <input class="form-control" id="fname" type="text" name="firstname">
                                    <label for="lastname">Lastname &#42;</label><br>
                                    <input class="form-control" id="lname" type="text" name="lastname">
                                    <label for="email">Email &#42;</label><br>
                                    <input class="form-control" id="email" type="email" name="email">
                                    <label for="password1">Password</label>
                                    <input class="form-control" id="password" type="password" name="password1">
                                    <span id="passerror"></span><br>
                                    <label for="password2">Confirm Password</label><br>
                                    <input class="form-control" id="cpassword" type="password" name="password2">
                                    <button class="btn btn-general" name="signupbtn" id="signupbtn">Signup</button><br>
                                    <div class="text-center"><a href="login.php">Already have an account? Login</a></div>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Login Page End-->
        
    </body>

<!--Jquery-->
<script src="js/jquery.js"></script>

<!--Custom JS-->
<script src="js/signup.js"></script>

</html>