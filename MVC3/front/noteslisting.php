<?php include "../includes/db.php" ;?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
       
       <!--important meta tags-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>MarketPlace</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/noteslisting.css">
        
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
                            </ul>
                        </div>
                    </div>
                    <!--main menu end-->
                </div>
               </div>
                
            </nav>
            
        </header>
        <!--Header End-->
        
        <!--Search Note BG-->
        <section id="searchnotebackground">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                           <div id="searchnotebg">
                               <h2>Search Notes</h2>
                           </div>
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--Search Note End-->
        
        <!--Basic profile-->
        <section id="basic">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                                <h2>Search and Filters</h2>
                            </div>
                        </div>
        
                    </div>
                    
                    <div id="filter">
                       
                        <div class="row">
                            <div class="col-md-12" id="searchfil">
                                <form>
                                    <i class="fa fa-search"></i>
                                    <input id="search-note-main" type="text" onkeyup="showNotes()" placeholder="Search your notes...">
                                </form>
                            </div>
                        </div>    
                        
                    
                        <div class="row">
                            <div class="col-md-1 filterpart">
                                <form>
                                    <select id="search_type" name="type" size="1" onchange="showNotes()">
                                        <option value="Type0">Select type</option>
                                        <?php 
                                        
                                            $userid=$_SESSION['id'];
                                            $query="SELECT * FROM notetypes";
                                            $search_result=mysqli_query($connection,$query);
                                                
                                            while($row = mysqli_fetch_assoc($search_result)){
                                                $types=$row['name'];
                                                
                                                echo "<option value='$types'>$types</option>";
                                                
                                            }
                                        ?>
                                    </select>
                                </form>
                            </div>

                            <div class="col-md-1 filterpart">
                                <form>
                                    <select id="search_category" name="category" size="1" onchange="showNotes()">
                                        <option value="category0">Select category</option>
                                        <?php 
                                        
                                            $userid=$_SESSION['id'];
                                            $query="SELECT * FROM notecategories";
                                            $search_result=mysqli_query($connection,$query);
                                                
                                            while($row = mysqli_fetch_assoc($search_result)){
                                                $categories=$row['name'];
                                                
                                                echo "<option value='$categories'>$categories</option>";
                                                
                                            }
                                        ?>
                                    </select>
                                </form>
                            </div>

                            <div class="col-md-1 filterpart">
                                <form>
                                    <select id="search_university" name="university" size="1" onchange="showNotes()">
                                        <option value="university0">Select university</option>
                                        <?php 
                                        
                                            $userid=$_SESSION['id'];
                                            $query="SELECT DISTINCT * FROM sellernotes WHERE sellerid=$userid";
                                            $search_result=mysqli_query($connection,$query);
                                                
                                            while($row = mysqli_fetch_assoc($search_result)){
                                                $university=$row['university'];
                                                
                                                echo "<option value='$university'>$university</option>";
                                                
                                            }
                                        ?>
                                    </select>
                                </form>
                            </div>

                            <div class="col-md-1 filterpart">
                               <form>
                                    <select id="search_course" name="course" size="1" onchange="showNotes()">
                                        <option value="course0">Select course</option>
                                        <?php 
                                        
                                            $userid=$_SESSION['id'];
                                            $query="SELECT * FROM sellernotes WHERE sellerid=$userid";
                                            $search_result=mysqli_query($connection,$query);
                                                
                                            while($row = mysqli_fetch_assoc($search_result)){
                                                $course=$row['course'];
                                                
                                                echo "<option value='$course'>$course</option>";
                                                
                                            }
                                        ?>
                                    </select>
                                </form>
                            </div>

                            <div class="col-md-1 filterpart">
                                <form>
                                    <select id="search_country" name="country" size="1" onchange="showNotes()">
                                        <option value="country0">Select country</option>
                                        <?php 
                                        
                                            $userid=$_SESSION['id'];
                                            $query="SELECT * FROM countries";
                                            $search_result=mysqli_query($connection,$query);
                                                
                                            while($row = mysqli_fetch_assoc($search_result)){
                                                $country=$row['name'];
                                                
                                                echo "<option value='$country'>$country</option>";
                                            }
                                        ?>
                                    </select>
                                </form>
                            </div>

                            <div class="col-md-1 filterpart">
                                <form>
                                    <select id="search_rating" name="rating" size="1">
                                        <option value="0">Select rating</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
        
            </div>
        
        </section>
        <!--Note Listing Details End-->
        
        <!--Basic profile-->
        <!--<section id="Basic">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                               <?php
                                    /*$query="SELECT * FROM sellernotes WHERE status=3";
                                    $result=mysqli_query($connection,$query);
                                    $rows=mysqli_num_rows($result);

                                    echo "<h4>Total $rows notes</h4>";*/
                                ?>
                                
                            </div>
                        </div>
        
                    </div>
                    
                    <div class="row dataelements text-center">
        
                       <div class="item">
                          
                          
                            <?php 
                                /*$query="SELECT * FROM sellernotes WHERE status=3";
                                $search_result=mysqli_query($connection,$query);

                                while($row = mysqli_fetch_assoc($search_result)){
                                    $title=$row['title'];
                                    $noteid=$row['id'];
                                    $image=$row['displaypic'];
                                    $university=$row['university'];
                                    $noofpage=$row['noofpage'];
                                    $date=$row['publisheddate'];
                                    $date=date('D d M Y',strtotime($date));*/
                                ?>    
                                    <div class="col-md-4 searchpart">
                                        <div class="row">
                                            <div class="col-md-12 label">
                                                <img style="height:250px;width:100%;" src="<?php /*echo $image;*/ ?>" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class='col-md-12 cont text-left'>
                                                <h4><a style="text-decoration:none;" href='noteview.php?noteid=<?php /*echo $noteid;*/ ?>'><?php /*echo $title;*/ ?></a></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src='images/Front_images/images/university.png'>
                                            </div>
                                            <div class="col-md-10 text-left">
                                                <p><?php/* echo $university;*/ ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="images/Front_images/images/pages.png">
                                            </div>
                                            <div class="col-md-10 text-left">
                                                <p><?php /*echo $noofpage;*/ ?> Pages</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src='images/Front_images/images/date.png'>
                                            </div>
                                            <div class="col-md-10 text-left">
                                                <p><?php /*echo $date;*/ ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class='col-md-2'>
                                                <img src='images/Front_images/images/flag.png'>
                                            </div>
                                            <div class='col-md-10 text-left'>
                                                <p style="color:red;">
                                                
                                                <?php 
                                                    /*$result=mysqli_query($connection,"SELECT * FROM sellernotesreport WHERE noteid='$noteid'");
                                                    echo mysqli_num_rows($result);
                                                    
                                                    */?> Users marked this note as inappropriate</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="star">
                                                    <img src="images/Front_images/images/star.png">
                                                    <img src="images/Front_images/images/star.png">
                                                    <img src="images/Front_images/images/star.png">
                                                    <img src="images/Front_images/images/star.png">
                                                    <img src="images/Front_images/images/star.png">
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <p><?php 
                                                        /*$result=mysqli_query($connection,"SELECT * FROM sellernotesview WHERE noteid='$noteid'");
                                                        echo mysqli_num_rows($result);
                                                    */?> Reviews</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php    
                                    
                               /* }*/
                                
                            ?>
                            
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
                           
                       </div>
                      
                    </div>
        
                </div>
        
            </div>
        
        </section>
        Note Listing Details End-->
        
        <script type="text/javascript">
        function showNotes(page_current) {
            let search_str = $("#search-note-main").val();
            let search_type = $("#search_type").val();
            let search_category = $("#search_category").val();
            let search_university = $("#search_university").val();
            let search_course = $("#search_course").val();
            let search_country = $("#search_country").val();
            let search_rating = $("#search_rating").val();

            $.ajax({
                url: "ajax/search-note-ajax.php",
                method: "GET",
                data: {
                    selected_search: search_str,
                    selected_type: search_type,
                    selected_category: search_category,
                    selected_university: search_university,
                    selected_course: search_course,
                    selected_country: search_country,
                    selected_rating: search_rating,
                    page: page_current
                },
                success: function(search_data) {
                    $("#dynamic_result").html(search_data);
                }
            });
        }
        $(function() {
            showNotes(1);
        });
        </script>

        <!-- data from ajax will display in this  -->
        <div id="dynamic_result"></div>
        
        <footer>
            <!--Footer-->
            <div class="content-box-lg">

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
            
        </footer>
        <!--Footer End-->
        
        <!--Jquery-->
        <script src="js/jquery.js"></script>
        
        <!--Bootstrap JS-->
        <script src="js/bootstrap/bootstrap.min.js"></script>
        
        <!--custom JS-->
        <script src="js/notelisting.js"></script>
        
    </body>
</html>