<?php include "../includes/db.php"; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html>
   
    <head>
       
        <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Login</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Responsive CSS-->
        <link rel="stylesheet" href="css/responsive.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/login.css">
        
        
    </head>
    
    <body>
        
        <!--Login Page-->
        <section id="login">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
                       
                       <div class="col-md-12">
                           <!--logo-->
                            <a href="main.php" class="navbar-brand logo">
                                <img src="images/Front_images/images/logo.png" alt="logo" class="img-responsive">
                            </a>
                       </div>
                       
                    </div>
                    
                    <div class="row">
                        <div id="loginpart" >
                           
                            <div class="col-md-12 col-xs-12 text-center">
                                <h2>Login</h2>
                                <p>Enter your email address and password to login</p>
                            </div>
                            
<?php
if(isset($_POST['loginbtn'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    $email=mysqli_real_escape_string($connection,$email);
    $password=mysqli_real_escape_string($connection,$password);
    
    $query="SELECT * from users WHERE emailID='$email'";
    $result=mysqli_query($connection,$query);
    
    if($row = mysqli_fetch_assoc($result)){
        $useremail=$row['emailID'];
        $userpassword=$row['password'];
        $role_id=$row['roleid'];
        $id=$row['id'];
    }
    
    if(!empty($_POST["remember"])) {
        setcookie ("email",$_POST["email"],time()+ 3600);
        setcookie ("password",$_POST["password"],time()+ 3600);
    } else {
        setcookie("email","");
        setcookie("password","");
    }

    $hashformat="$2y$10$";
    $salt="iusesomecrazystrings22";
    $hashsalt=$hashformat.$salt;
    $password=crypt($password,$hashsalt);
    
    if($useremail===$email && $password===$userpassword){
        $_SESSION['id']=$id;
        if($role_id=="2"){
            header('Location: dashboard.php');
        }else{
            header('Location: /notemarketplace/admin/admindash.php');
        }
        
    }else{
        header('Location: /notemarketplace/front/login.php');
    }
    
    
}  
?>
                           
                            <div class="col-md-12 col-sm-12 col-xs-6">
                                <form class="form-group" name="loginform" onsubmit="return validateform()" action="" method="post">
                                    <label for="Email">Email</label><br>
                                    <input class="form-control" type="email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>" name="email" placeholder="Enter your email" required>
                                    <label for="password">Password</label>
                                    <span id="fpwd"><a href="forgotpass.php">Forgot Password?</a><br></span>
                                    <input class="form-control" type="password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>" name="password" placeholder="Enter your password" required>
                                    <input type="checkbox" id="remember" name="remember" value="remember" <?php if(isset($_COOKIE['email'])){ ?> checked <?php } ?> >
                                    <label for="remember">Remember Me</label>
                                    <button name="loginbtn" value="login" class="btn btn-general" id="loginbtn">Login</button><br>
                                    <div class="text-center signuplink"><a href="signup.php">Don't have an account? Sign up</a></div>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Login Page End-->
        
        
    </body>
    
    <!--Custom JS-->
    <script src="js/login.js"></script>
    
</html>


