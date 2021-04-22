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
        
        <title>Add Notes</title>
        
        <!--Font awesome-->
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="css/addnotes.css">
        
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
                                <img src="images/Front_images/images/logo.png" alt="logo" class="img-responsive">
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
                                        <input type="image" style="border-radius:50%;" src="../uploadeds/<?php echo $profilepicture; ?>" class="smooth-scroll dropbtn img-responsive" onclick="myFunction()">
                                            <div id="myDropdown" class="dropdown-content">
                                                <a href="userprofile.php">Update Profile</a>
                                                <a href="forgotpass.php">Change Password</a>
                                                <a href="login.php">Logout</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="smooth-scroll" href="logout.php"><button onclick="return confirm('Are you sure, you want to logout?');" id=logoutbtn>Logout</button></a></li>
                                </ul>
                            </div>
                        </div>
                        <!--main menu end-->
                    </div>
               </div>
                
            </nav>
            
        </header>
        <!--Header End-->
        
        <!--Add Note BG-->
        <section id="addnotebackground">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                           <div id="addnotebg">
                                <h2>Add Notes</h2>
                           </div>
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
        </section>
        <!--User Profile BG End-->
        
<?php

$sellerid=$_SESSION['id'];

if(isset($_POST['publishbtn'])){
    
    $status="1";
    $date=date('dd-mm-yy');
    $title=$_POST['title'];
    $category=$_POST['category'];
    $type=$_POST['type'];
    $noofpages=$_POST['noofpages'];
    $description=$_POST['description'];
    $country=$_POST['country'];
    $iname=$_POST['iname'];
    $coursename=$_POST['coursename'];
    $coursecode=$_POST['coursecode'];
    $professor=$_POST['professor'];
    $coursecode=$_POST['coursecode'];
    $sellfor=$_POST['sellfor'];
    if($sellfor=='free'){
        $sellprice=0;
    }else{
        $sellprice=$_POST['sellprice'];
    }

    $query="INSERT into sellernotes (sellerid,status,actionedby,publisheddate,title,category,notetype,noofpage,description,university,country,course,coursecode,professor,ispaid,sellingprice,createddate,createdby,modifieddate,isactive) ";
    $query.="VALUES ('$sellerid','$status',1,now(),'$title','$category','$type','$noofpages','$description','$iname','$country','$coursename','$coursecode','$professor','$sellfor','$sellprice',now(),'$userid',now(),'1')";

    $result = mysqli_query($connection,$query);
    
    //to get above note id
    $note_id = mysqli_insert_id($connection);
    
    $valid_format_1 = true;
    $valid_format_2 = true;
    $valid_format_3 = true;
    
    //display picture
    $display_pic = $_FILES['displaypicture'];
    $filename = $display_pic['name'];
    $filetmp = $display_pic['tmp_name'];
    $extention = explode('.', $filename);
    $filecheck = strtolower(end($extention));
    $fileextstored = array('jpg', 'png', 'jpeg');

    if (in_array($filecheck, $fileextstored)) {
        if (!is_dir("../uploaded/")) {
            mkdir('../uploaded/');
        }
        if (!is_dir("../uploaded/" . $sellerid)) {
            mkdir("../uploaded/" . $sellerid);
        }
        if (!is_dir("../uploaded/" . $sellerid . "/" . $note_id)) {
            mkdir('../uploaded/' . $sellerid . '/' . $note_id);
        }
        $destinationfile = '../uploaded/' . $sellerid . '/' . $note_id . '/' . "DP_" . time() . '.' . $filecheck;
        move_uploaded_file($filetmp, $destinationfile);
        $query_pic = "UPDATE sellernotes SET displaypic='$destinationfile' WHERE id=$note_id";
        $result_pic = mysqli_query($connection, $query_pic);
    } else {
        $valid_format_1 = false;
    }
    
    //Note Preview
    $note_preview = $_FILES['notepre'];
    $filename2 = $note_preview['name'];
    $filetmp2 = $note_preview['tmp_name'];
    $extention2 = explode('.', $filename2);
    $filecheck2 = strtolower(end($extention2));
    $fileextstored2 = array('pdf');

    if (in_array($filecheck2, $fileextstored2)) {
        if (!is_dir("../uploaded/")) {
            mkdir('../uploaded/');
        }
        if (!is_dir("../uploaded/" . $sellerid)) {
            mkdir("../uploaded/" . $sellerid);
        }
        if (!is_dir("../uploaded/" . $sellerid . "/" . $note_id)) {
            mkdir('../uploaded/' . $sellerid . '/' . $note_id);
        }
        $destinationfile2 = '../uploaded/' . $sellerid . '/' . $note_id . '/' . "Preview_" . time() . '.' . $filecheck2;
        move_uploaded_file($filetmp2, $destinationfile2);
        $query_preview = "UPDATE sellernotes SET notespreview='$destinationfile2' WHERE id=$note_id";
        $result_preview = mysqli_query($connection, $query_preview);
    } else {
        $valid_format_3 = false;
    }
    
    /*$upload_note = count($_FILES['uploadnotes']['name']);*/
    /*$upload_note=1;
    
    for ($i = 0; $i < $upload_note; $i++) {*/

        $filename3 = $_FILES['uploadnotes']['name']/*[$i]*/;
        $extention3 = explode('.', $filename3);
        $filecheck3 = strtolower(end($extention3));
        $fileextstored3 = array('pdf');

        if (in_array($filecheck3, $fileextstored3)) {
            $query_multiple_path = "INSERT INTO sellernotesattachment (noteid,createddate,createdby,isactive) 
                                VALUES ($note_id,NOW(),$sellerid,1)";
            $result_multiple_path = mysqli_query($connection, $query_multiple_path);

            $attach_id = mysqli_insert_id($connection);

            // Upload file
            if (!is_dir("../uploaded/")) {
                mkdir('../uploaded/');
            }
            if (!is_dir("../uploaded/" . $sellerid)) {
                mkdir("../uploaded/" . $sellerid);
            }
            if (!is_dir("../uploaded/" . $sellerid . "/" . $note_id)) {
                mkdir('../uploaded/' . $sellerid . '/' . $note_id);
            }
            if (!is_dir("../uploaded/" . $sellerid . "/" . $note_id . "/" . "Attachements")) {
                mkdir('../uploaded/' . $sellerid . '/' . $note_id . '/' . 'Attachements');
            }

            $multiple_file_name = '../uploaded/' . $sellerid . '/' . $note_id . '/' . 'Attachements/' . $attach_id . '_' . time() . '.' . $filecheck3;
            move_uploaded_file($_FILES['uploadnotes']['tmp_name']/*[$i]*/, $multiple_file_name);

            $attached_name = $attach_id . "_" . time() . $filecheck3;
            $query_final="UPDATE sellernotes SET uploadnotes='$multiple_file_name' WHERE id=$note_id";
            $result_final=mysqli_query($connection,$query_final);
            $query_multiple_final = "UPDATE sellernotesattachment SET filename='$attached_name',filepath='$multiple_file_name' WHERE id =$attach_id";
            $result_multiple_final = mysqli_query($connection, $query_multiple_final);
        } else {
            $valid_format_2 = false;
        }
    /*}*/
    
    $seller_query=mysqli_query($connection,"SELECT * FROM users WHERE id='$sellerid'");
    while($row=mysqli_fetch_assoc($seller_query)){
        $sellername=$row['firstname'];
    }
    $admin_query=mysqli_query($connection,"SELECT * FROM users WHERE roleid=1");
    while($row=mysqli_fetch_assoc($admin_query)){
        $adminemail=$row['emailID'];
    }
    
    if(!empty($sellerid)){

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


            $mail->addAddress($adminemail, 'NotesMarketPlace Admin');  // This email is where you want to send the email
            $mail->addReplyTo($config_email, 'Sender name');   // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true);  // You can set it to false if you want to send raw text in the body
            $mail->Subject = "$sellername Allows you to download a note";       //subject line of email
            $mail->Body = "<p>Hello Admins,</p><br><br><p>We want to inform you that, $sellername sent his note
            $title for review. Please look at the notes and take required actions.</p><br><p>Regards,</p><br>";   //Email body
            $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email

            $mail->send();
            $email_sent= "Thank You For Contacting us! We will try to resolve your issue as soon as posibble!";
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    
    header("Location:dashboard.php");
    
}
   
else if(isset($_POST['savebtn'])){
    $status="0";
    $date=date('dd-mm-yy');
    $title=$_POST['title'];
    $category=$_POST['category'];
    $type=$_POST['type'];
    $noofpages=$_POST['noofpages'];
    $description=$_POST['description'];
    $country=$_POST['country'];
    $iname=$_POST['iname'];
    $coursename=$_POST['coursename'];
    $coursecode=$_POST['coursecode'];
    $professor=$_POST['professor'];
    $coursecode=$_POST['coursecode'];
    $sellfor=$_POST['sellfor'];
    if($sellfor=='free'){
        $sellprice=0;
    }else{
        $sellprice=$_POST['sellprice'];
    }

    $query="INSERT into sellernotes (sellerid,status,actionedby,publisheddate,title,category,notetype,noofpage,description,university,country,course,coursecode,professor,ispaid,sellingprice,createddate,createdby,modifieddate,isactive) ";
    $query.="VALUES ('$sellerid','$status',1,now(),'$title','$category','$type','$noofpages','$description','$iname','$country','$coursename','$coursecode','$professor','$sellfor','$sellprice',now(),'$userid',now(),'1')";

    $result = mysqli_query($connection,$query);
    
    //to get above note id
    $note_id = mysqli_insert_id($connection);
    
    $valid_format_1 = true;
    $valid_format_2 = true;
    $valid_format_3 = true;
    
    
    //display picture
    $display_pic = $_FILES['displaypicture'];
    $filename = $display_pic['name'];
    $filetmp = $display_pic['tmp_name'];
    $extention = explode('.', $filename);
    $filecheck = strtolower(end($extention));
    $fileextstored = array('jpg', 'png', 'jpeg');

    if (in_array($filecheck, $fileextstored)) {
        if (!is_dir("../uploaded/")) {
            mkdir('../uploaded/');
        }
        if (!is_dir("../uploaded/" . $sellerid)) {
            mkdir("../uploaded/" . $sellerid);
        }
        if (!is_dir("../uploaded/" . $sellerid . "/" . $note_id)) {
            mkdir('../uploaded/' . $sellerid . '/' . $note_id);
        }
        $destinationfile = '../uploaded/' . $sellerid . '/' . $note_id . '/' . "DP_" . time() . '.' . $filecheck;
        move_uploaded_file($filetmp, $destinationfile);
        $query_pic = "UPDATE sellernotes SET displaypic='$destinationfile' WHERE id=$note_id";
        $result_pic = mysqli_query($connection, $query_pic);
    } else {
        $valid_format_1 = false;
    }
    
    //Note Preview
    $note_preview = $_FILES['notepre'];
    $filename2 = $note_preview['name'];
    $filetmp2 = $note_preview['tmp_name'];
    $extention2 = explode('.', $filename2);
    $filecheck2 = strtolower(end($extention2));
    $fileextstored2 = array('pdf');

    if (in_array($filecheck2, $fileextstored2)) {
        if (!is_dir("../uploaded/")) {
            mkdir('../uploaded/');
        }
        if (!is_dir("../uploaded/" . $sellerid)) {
            mkdir("../uploaded/" . $sellerid);
        }
        if (!is_dir("../uploaded/" . $sellerid . "/" . $note_id)) {
            mkdir('../uploaded/' . $sellerid . '/' . $note_id);
        }
        $destinationfile2 = '../uploaded/' . $sellerid . '/' . $note_id . '/' . "Preview_" . time() . '.' . $filecheck2;
        move_uploaded_file($filetmp2, $destinationfile2);
        $query_preview = "UPDATE sellernotes SET notespreview='$destinationfile2' WHERE id=$note_id";
        $result_preview = mysqli_query($connection, $query_preview);
    } else {
        $valid_format_3 = false;
    }
    
    /*$upload_note = count($_FILES['uploadnotes']['name']);*/
    /*$upload_note=1;
    
    for ($i = 0; $i < $upload_note; $i++) {*/

        $filename3 = $_FILES['uploadnotes']['name']/*[$i]*/;
        $extention3 = explode('.', $filename3);
        $filecheck3 = strtolower(end($extention3));
        $fileextstored3 = array('pdf');

        if (in_array($filecheck3, $fileextstored3)) {
            $query_multiple_path = "INSERT INTO sellernotesattachment (noteid,createddate,createdby,isactive) 
                                VALUES ($note_id,NOW(),$sellerid,1)";
            $result_multiple_path = mysqli_query($connection, $query_multiple_path);

            $attach_id = mysqli_insert_id($connection);

            // Upload file
            if (!is_dir("../uploaded/")) {
                mkdir('../uploaded/');
            }
            if (!is_dir("../uploaded/" . $sellerid)) {
                mkdir("../uploaded/" . $sellerid);
            }
            if (!is_dir("../uploaded/" . $sellerid . "/" . $note_id)) {
                mkdir('../uploaded/' . $sellerid . '/' . $note_id);
            }
            if (!is_dir("../uploaded/" . $sellerid . "/" . $note_id . "/" . "Attachements")) {
                mkdir('../uploaded/' . $sellerid . '/' . $note_id . '/' . 'Attachements');
            }

            $multiple_file_name = '../uploaded/' . $sellerid . '/' . $note_id . '/' . 'Attachements/' . $attach_id . '_' . time() . '.' . $filecheck3;
            move_uploaded_file($_FILES['uploadnotes']['tmp_name']/*[$i]*/, $multiple_file_name);

            $attached_name = $attach_id . "_" . time() . $filecheck3;
            $query_final="UPDATE sellernotes SET uploadnotes='$multiple_file_name' WHERE id=$note_id";
            $result_final=mysqli_query($connection,$query_final);
            $query_multiple_final = "UPDATE sellernotesattachment SET filename='$attached_name',filepath='$multiple_file_name' WHERE id =$attach_id";
            $result_multiple_final = mysqli_query($connection, $query_multiple_final);
        } else {
            $valid_format_2 = false;
        }
    /*}*/
    header("Location:dashboard.php");
    
}

?>
        <form action="addnotes.php" method="post" enctype="multipart/form-data">
            <!--Basic profile-->
            <section id="Basic">

                <div class="content-box-lg">

                    <div class="contanier">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Basic Note Details</h2>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="title">Title &#42;</label><br>
                                    <input class="form-control" type="text" id="title" name="title">
                                </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="category">Category &#42;</label><br>
                                    <select class="form-control" id="category" name="category" size="1">
                                        <option value="">Select Category</option>
                                        <?php 
                                            $query="SELECT * FROM notecategories";
                                            $search_result=mysqli_query($connection,$query);
                                                
                                            while($row = mysqli_fetch_assoc($search_result)){
                                                $categories=$row['name'];
                                                
                                                echo "<option value='$categories'>$categories</option>";
                                                
                                            }
                                        ?>
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="displaypicture">Display Picture</label><br>
                                    <div class="upload">
                                        <img src="images/Front_images/images/upload-file.png">
                                    </div>
                                    <input class="form-control" type="file" id="displaypicture" name="displaypicture">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="uploadnotes">Upload Notes</label><br>
                                    <div class="upload">
                                        <img src="images/Front_images/images/upload-note.png">
                                    </div>
                                    <input class="form-control" type="file" id="uploadnotes" name="uploadnotes">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type</label><br>
                                    <select class="form-control" id="type" name="type" size="1">
                                        <option value="">Select Type</option>
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
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="noofpages">Number of Pages</label><br>
                                    <input class="form-control" type="number" id="nop" name="noofpages">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label><br>
                                    <textarea class="col-md-12 form-control" id="description" name="description" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!--Basic Note Details End-->

            <!--Institution Info profile-->
            <section id="insitinfo">

                <div class="content-box-lg">

                    <div class="contanier">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Institution Information</h2>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country</label><br>
                                    <select class="form-control" id="country" name="country" size="1">
                                        <option value="india">Select Country</option>
                                        <?php 
                                            $query="SELECT * FROM countries";
                                            $search_result=mysqli_query($connection,$query);
                                                
                                            while($row = mysqli_fetch_assoc($search_result)){
                                                $countries=$row['name'];
                                                
                                                echo "<option value='$countries'>$countries</option>";
                                                
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="iname">Insitution Name</label><br>
                                    <input class="form-control" type="text" id="iname" name="iname">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!--Institution Information End-->

            <!--Course Details-->
            <section id="coursedetails">

                <div class="content-box-lg">

                    <div class="contanier">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Course Details</h2>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="coursename">Course Name</label><br>
                                    <input class="form-control" type="text" id="cname" name="coursename">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="coursecode">Course Code</label><br>
                                    <input class="form-control" type="text" id="ccode" name="coursecode">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="professor">Professor/Lecturer</label><br>
                                    <input class="form-control" type="text" id="prof" name="professor">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!--Course Details End-->

            <!--Selling Information-->
            <section id="sellinfo">

                <div class="content-box-lg">

                    <div class="contanier">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="horizontal-heading">
                                    <h2>Selling Information</h2>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sellfor">Sell For</label><br>
                                            <input type="radio" id="sellwithfree" name="sellfor" value="free" checked>Free
                                            <input type="radio" id="sellwithpaid" name="sellfor" value="paid">Paid
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group sellprice">
                                            <label for="sellprice">Sell Price</label><br>
                                            <input class="form-control" type="number" id="sprice" name="sellprice">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-general" name="savebtn" id="savebtn">Save</button>
                                            <button class="btn btn-general" onclick="return confirm('Are you sure for publish note?');" name="publishbtn" id="publishbtn">Publish</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="notepre">Note Preview</label><br>
                                    <div class="upload">
                                        <img src="images/Front_images/images/upload-file.png">
                                    </div>
                                    <input class="form-control" type="file" id="notepre" name="notepre">
                                </div>
                            </div>
                            
                            .

                        </div>

                    </div>

                </div>

            </section>
        </form>
        <!--Selling Information End-->
        
        <footer>
            <!--Footer-->
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

    <!--Custom JS-->
    <script src="js/addnotes.js"></script>
    
</html>