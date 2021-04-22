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
                            <a href="main.html" class="navbar-brand logo">
                                <img src="images/Front_images/images/logo.png" alt="logo">
                            </a>
                       </div>
                       
                    </div>
                    
                    <div class="row">
                        <div id="loginpart" >
                           
                            <div class="col-md-12 text-center">
                                <h2>Login</h2>
                                <p>Enter your email address and password to login</p>
                            </div>

                            <div class="col-md-12">
                                <form>
                                    <label for="Email">Email</label><br>
                                    <input id="email" type="email" name="Email" placeholder="Enter your email" required>
                                </form>
                            </div>

                            <div class="col-md-12">
                                <form>
                                    <label for="Password">Password</label>
                                    <span id="fpwd"><a href="forgotpass.html">Forgot Password?</a><br></span>
                                    <input id="password" type="password" name="Password" placeholder="Enter your password" required>
                                </form>
                            </div>

                            <div class="col-md-12">
                                <form>
                                    <input type="checkbox" id="remember" name="Remember" value="remember">
                                    <label for="Remember">Remember Me</label>
                                </form>
                            </div>

                            <div class="col-md-12 text-center">
                                <form>
                                    <button type="button" href="#" id="loginbtn">Login</button><br>
                                    <a href="signup.html">Don't have an account? Sign up</a>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Login Page End-->
        
    </body>
    
</html>