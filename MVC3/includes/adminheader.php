<?php /*include "db.php";*/ ?>
<?php /*session_start();*/ ?>
      
       <!--Header-->
        <header>
            
            <nav class="navbar navbar-fixed-top">
               <div class="container-fluid">
                   <div class="site-nav-wrapper">

                        <div class="navbar-header">

                            <!--logo-->
                            <a href="main.html" class="navbar-brand smooth-scroll">
                                <img src="images/Admin_images/images/logo.png" alt="logo">
                            </a>
                        </div>

                        <!--main menu-->
                        <div class="container">
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav pull-right">
                                    <li><a class="smooth-scroll" href="admindash.php">Dashboard</a></li>
                                    <li>
                                        <div class="notedropdown">
                                            <button type="" class="dropbutton smooth-scroll">Notes</button>
                                            <div class="note-dropdown-content">
                                                <a href="notereview.php">Notes Under Review </a>
                                                <a href="adpublished.php">Published Notes</a>
                                                <a href="addownload.php">Downloaded Notes</a>
                                                <a href="adrejected.php">Rejected Notes</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="smooth-scroll" href="member.php">Members</a></li>
                                    <li>
                                        <div class="notedropdown">
                                            <button type="" class="dropbutton smooth-scroll">Reports</button>
                                            <div class="note-dropdown-content">
                                                <a href="spamreport.php">Spam Report</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notedropdown">
                                            <button type="" class="dropbutton smooth-scroll">Settings</button>
                                            <div class="note-dropdown-content">
                                                <?php 
                                                    if(isset($_SESSION['id'])){
                                                        $userid=$_SESSION['id'];
                                                        $query="SELECT roleid FROM USERS WHERE id='$userid'";
                                                        $result=mysqli_query($connection,$query);
                                                        if($row=mysqli_fetch_assoc($result)){
                                                            $roleid=$row['roleid'];
                                                        }
                                                        if($roleid=='1'){
                                                            echo "<a href='sysconf.php'>Manage System Configuration</a>";
                                                            echo "<a href='manageadmin.php'>Manage Administrator</a>";
                                                        }
                                                        
                                                    }
                                                ?>
                                                <a href="managecat.php">Manage Category</a>
                                                <a href="managetype.php">Manage Type</a>
                                                <a href="managecountry.php">Manage Countries</a>
                                            </div>
                                        </div>
                                    </li>
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
                                        <input type="image" style="border-radius:50%;height:40px;width:40px;" src="../uploaded/<?php echo $profilepicture; ?>" class="smooth-scroll dropbtn img-responsive" onclick="myFunction()">
                                            <div id="myDropdown" class="dropdown-content">
                                                <a href="myprofile.php">Update Profile</a>
                                                <a href="../front/cpass.php">Change Password</a>
                                                <a href="../front/logout.php" style="color:#6255a5;text-transform:uppercase;">Logout</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="smooth-scroll" href="../front/logout.php"><button id=logoutbtn>Logout</button></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--main menu end-->
                    </div>
               </div>
                
            </nav>
            
        </header>
        <!--Header End-->