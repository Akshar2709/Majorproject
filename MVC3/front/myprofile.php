<!DOCTYPE hmtl>
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
        <link rel="stylesheet" href="css/myprofile.css">
        
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
                                    <li><a class="smooth-scroll" href="dashboard.html">Dashboard</a></li>
                                    <li><a class="smooth-scroll" href="noteview.html"> Notes</a></li>
                                    <li><a class="smooth-scroll" href="buyerreq.html">Members</a></li>
                                    <li><a class="smooth-scroll" href="faq.html">Reports</a></li>
                                    <li><a class="smooth-scroll" href="contact.html">Settings</a></li>
                                    <li><a class="smooth-scroll" href="#"><img src="images/Front_images/images/user-img.png"></a></li>
                                    <li><a class="smooth-scroll" href="login.html"><button id=logoutbtn>Logout</button></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--main menu end-->
                    </div>
               </div>
                
            </nav>
            
        </header>
        <!--Header End-->
        
        <!--Basic profile-->
        <section id="myprofile">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <h2>My Profile</h2>
                            </div>
                        </div>
        
                    </div>
                    
                    <div class="row">
        
                        <div class="col-md-6">
                            <form>
                                <label for="fname">First Name &#42;</label><br>
                                <input type="text" id="fname" name="fname" placeholder="Enter your first name">
                                
                                <label for="lname">Last Name &#42;</label><br>
                                <input for="lname" type="text" id="lname" name="lname" placeholder="Enter your last exam">
                                
                                <label for="email">Email &#42;</label><br>
                                <input for="email" type="email" id="email" name="email" placeholder="Enter your email address">
                                
                                <label for="secemail">Secondary Email</label><br>
                                <input for="secemail" type="email" id="secemail" name="secemail" placeholder="Enter your email address">
                                
                                <label for="phone">Phone Number</label><br>
                                <input type="number" id="phone" name="phone" placeholder="Enter your phone number">
                                
                                <label for="displaypicture">Display Picture</label><br>
                                <div class="upload">
                                    <img src="images/Front_images/images/upload-file.png">
                                </div>
                                <input type="file" id="displaypicture" name="displaypicture">
                                
                                <button id="submitbtn" type="button">Submit</button>
                                
                            </form>
                        </div>
                        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Basic Note Details End-->
        
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
        
    </body>
</html>