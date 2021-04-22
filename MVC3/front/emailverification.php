<?php include "../includes/db.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
   
    <head>
       
        <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Email Verification</title>
        
        
    </head>
    <?php
    
    if(isset($_GET['email'])){
            
            $email=$_GET['email'];
            $fname=$_GET['fname'];
            $lname=$_GET['lname'];
            $password=$_GET['password'];
            
            $query="INSERT into users (roleid,firstname,lastname,emailID,password,isemailverified,createddate,isactive) ";
            $query.="VALUES (2,'$fname','$lname','$email','$password','1',now(),1)";
            $result = mysqli_query($connection,$query);
            
            $query="SELECT * from users WHERE emailID='$email'";
            $result=mysqli_query($connection,$query);

            if($row = mysqli_fetch_assoc($result)){
                $id=$row['id'];
            }
            $_SESSION['id']=$id;
            
    }
    ?>
    
    <body>
        
        <h1>Thank you for Signup.</h1>
        <a href="login.php"> Please click here for login into the system.</a>
        
    </body>
    
    
</html>


