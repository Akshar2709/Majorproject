<?php include "../includes/db.php"?>
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
        
        <title>Forgot Password</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/forgotpass.css">
        
    </head>
    
    <body>
        
        <!--Forgot Password Page-->
        <section id="forgotpass">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
                       
                       <div class="col-md-12">
                           <!--logo-->
                            <a href="main.html" class="navbar-brand logo">
                                <img src="images/Front_images/images/logo.png" alt="logo">
                            </a>
                       </div>
                       
                    </div>
 
                    <div class="row">
                        <div id="forgotpasspart" >
                           
                            <div class="col-md-12 text-center">
                                <h2>Forgot Password?</h2>
                                <p>Enter your email to reset your password</p>
                            </div>
                            
<?php

if(isset($_POST['submitbtn'])){
    
    $email=$_POST['email'];
    
    $email=mysqli_real_escape_string($connection,$email);
    
    $password=rand(100000,10000000);
    
    $hashformat="$2y$10$";
    $salt="iusesomecrazystrings22";
    $hashsalt=$hashformat.$salt;
    $epassword=crypt($password,$hashsalt);
    
    $query="UPDATE users SET password='$epassword' WHERE emailID='$email'";
    $result=mysqli_query($connection,$query);
    
    if(!empty($email)){

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
            $mail->Subject = "New Temporary Password has been created for you";       //subject line of email
            $mail->Body = "<p>Hello</p><br><br><p>We have generated a new password for you</p><br><br><p>Password: $password</p><br>";   //Email body
            $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email

            $mail->send();
            $email_sent= "Thank You For Contacting us! We will try to resolve your issue as soon as posibble!";
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    
    echo  "<i class='fa fa-green'></i><p id='successnote' class='text-center'>Email is sent.Please verify it.</p>";
}
?>

                            <div class="col-md-12">
                                <form action="forgotpass.php" method="post">
                                    <label for="Email">Email</label><br>
                                    <input class="form-control" id="email" type="email" name="email" placeholder="Enter your email" required>
                                    <div class="text-center"><button class="btn btn-general" name="submitbtn" id="submitbtn">Submit</button></div>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Forgot Password Page End-->
        
    </body>
    
</html>