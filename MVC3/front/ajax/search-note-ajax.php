<?php

$db['db_host']="localhost";
$db['db_user']="root";
$db['db_pass']="";
$db['db_name']="notesmarketplace";

foreach($db as $key => $value){
    define(strtoupper($key),$value);
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//ternary operator to store data
(!empty(isset($_GET['selected_search'])))
    ? $selected_search = $_GET['selected_search'] : $selected_search = "";

(!empty(isset($_GET['selected_type'])))
    ? $selected_type = $_GET['selected_type'] : $selected_type = "";

(!empty(isset($_GET['selected_category'])))
    ? $selected_category = $_GET['selected_category'] : $selected_category = "";

(!empty(isset($_GET['selected_university'])))
    ? $selected_university = $_GET['selected_university'] : $selected_university = "";

(!empty(isset($_GET['selected_course'])))
    ? $selected_course = $_GET['selected_course'] : $selected_course = "";

(!empty(isset($_GET['selected_country'])))
    ? $selected_country = $_GET['selected_country'] : $selected_country = "";

(!empty(isset($_GET['selected_rating'])))
    ? $selected_rating = $_GET['selected_rating'] : $selected_rating = "";


//to get all the notes
$all_note_query = "SELECT DISTINCT sn.*,snr.ratings FROM sellernotes sn LEFT JOIN sellernotesview snr ON sn.id=snr.noteid WHERE sn.status=3 AND sn.title LIKE '%$selected_search%'";
$query_append = "";

//to append all the query
($selected_type != 0 && $selected_type != "")
    ? $query_append .= " OR sn.notetype='$selected_type'" : "";

($selected_category != 0 && $selected_category != "")
    ? $query_append .= " OR sn.category='$selected_category'" : "";

($selected_university != 0 && $selected_university != "")
    ? $query_append .= " OR sn.university='$selected_university'" : "";

($selected_course != 0 && $selected_course != "")
    ? $query_append .= " OR sn.course='$selected_course'" : "";

($selected_country != 0 && $selected_country != "")
    ? $query_append .= " OR sn.country='$selected_country'" : "";

($selected_rating != 0 && $selected_rating != "")
    ? $query_append .= " OR snr.ratings>$selected_rating " : "";


//display total count
$filter_search_result_all = mysqli_num_rows(mysqli_query($connection, $all_note_query . $query_append));

//pagination
(!empty(isset($_GET['page']))) && ($_GET['page'] != "") ? $page = $_GET['page'] : $page = 1;
$limit = 3;
$total_page = ceil($filter_search_result_all / $limit);
($page < 1) ? $page = 1 : "";
($filter_search_result_all > 0 && $total_page < $page) ? $page = $total_page : "";
$start_from = ($page - 1) * $limit;

//after the filter merge the query
$filter_search_query = $all_note_query . $query_append . " ORDER BY sn.publisheddate DESC " . "LIMIT " . $start_from . "," . $limit;
$filter_search_result = mysqli_query($connection, $filter_search_query);
?>
<script>
</script>
<!--<div id="search-result">
    <div class="container">
        <div class="row">
            <div id="search-result-heading">
                <div class="col-md-12 col-md-12 col-sm-12 col-12">
                    <?php
                    if ($filter_search_result_all != 0)
                        echo " <h2>Total " . $filter_search_result_all . " notes</h2>";
                    else
                        echo " <h2>No Record Found!</h2>";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <?php

            //to get all books data
            /*while ($row = mysqli_fetch_assoc($filter_search_result)) {
                $note_id = $row['id'];
                $note_pic = $row['displaypic'];
                $note_title = $row['title'];
                $university_name = $row['university'];
                $note_page = $row['noofpage'];
                $note_pub_date = $row['publisheddate']; */?>

            <div class="col-lg-4 col-md-6 col-sm-6 col-12 single-book-selecter">
                <?php /*echo "<a href='notes-details-page.php?id=$note_id'>";*/ ?>

                // display img
                <img src='<?php /*echo $note_pic*/ ?>' style="height:50px;width:50px;" class='img-fluid img-setter-search-result search-img-border'
                    title='Click to View <?php /*echo $note_title*/ ?>' alt='Book Cover photo of <?php /*echo $note_title*/ ?>'>
                <?php /*echo "</a>
                        <a href='notes-details-page.php?id=$note_id' title='Click to view $note_title'>";*/
                    ?>
                <div class="search-result-below-img">
                    <ul>
                        <li>
                            // display title
                            <h3> <?php /*echo $note_title;*/ ?> </h3>
                        </li>
                    </ul>
                    <div class="search-result-data">

                        //university name
                        <img class="search-icon-resizer" src="images/university-dark.png" alt="university">
                        <h6 class="search-result-data-body"><?php /*echo $university_name;*/ ?></h6>
                    </div>

                    //notes pages
                    <div class="search-result-data">
                        <img class="search-icon-resizer" src="images/book_open.png" alt="book">
                        <h6 class="search-result-data-body"><?php /*echo $note_page;*/ ?> Pages</h6>
                    </div>

                    // note publish date 
                    <div class="search-result-data">
                        <img class="search-icon-resizer" src="images/calender-blue.png" alt="calender">
                        <h6 class="search-result-data-body">
                            <?php /*echo date('D, F d Y', strtotime($note_pub_date)); */?></h6>
                    </div>

                    // imappropriate count
                    <div class="search-result-data">
                        <?php/* $appropriate_query = mysqli_query($connection, "SELECT * FROM sellernotesreport WHERE noteid=$note_id");
                            $appropriate_count = mysqli_num_rows($appropriate_query);
                            if ($appropriate_count > 0) {*/ ?>
                        <img class="search-icon-resizer" src="images/red-flag.png" alt="flag">
                        <h6 class="search-result-data-body search-result-red">
                            <?php /*echo $appropriate_count*/ ?>&nbspUser(s) have marked this note as
                            inappropriate</h6>
                        <?php/* } */?>
                    </div>

                    <?php/*
                        // display rating
                        $ratiing_getter = mysqli_query($connection, "SELECT AVG(ratings),COUNT(ratings) FROM sellernotesview WHERE noteid=$note_id");
                        while ($row = mysqli_fetch_assoc($ratiing_getter)) {
                            $ratiing_val = $row['AVG(ratings)'];
                            $total_rating = $row['COUNT(ratings)'];*/ ?>

                    // rating display 
                    <div class="note-page-star-setter">
                        <div id="<?php /*echo $note_id*/ ?>"></div>
                        <?php /*echo $total_rating > 0 ? "<h6>" . $total_rating . " Reviews</h6>" : "";*/ ?>
                    </div>
                    <?php /*}*/ ?>

                    <script>
                    $('#<?php /*echo $note_id*/ ?>').jsRapStar({
                        length: 5,
                        starHeight: 30,
                        colorFront: 'yellow',
                        enabled: false,
                        value: '<?php /*echo $ratiing_val*/ ?>',
                    });
                    </script>
                </div>
            </div>
            <?php /*}*/ ?>
        </div>
    </div>
</div>-->

<section id="Basic">
        
            <div class="content-box-lg">
        
                <div class="contanier">
        
                    <div class="row">
        
                        <div class="col-md-12">
                            <div class="horizontal-heading">
                               <?php
                                    $rows=mysqli_num_rows($filter_search_result);

                                    echo "<h4>Total $rows notes</h4>";
                                ?>
                                
                            </div>
                        </div>
        
                    </div>
                    
                    <div class="row dataelements text-center">
        
                       <div class="item">
                          
                          
                            <?php 
                                /*$query="SELECT * FROM sellernotes WHERE status=3";
                                $search_result=mysqli_query($connection,$query);*/
                                

                                while($row = mysqli_fetch_assoc($filter_search_result)){
                                    $title=$row['title'];
                                    $noteid=$row['id'];
                                    $image=$row['displaypic'];
                                    $university=$row['university'];
                                    $noofpage=$row['noofpage'];
                                    $date=$row['publisheddate'];
                                    $date=date('D d M Y',strtotime($date));
                                ?>    
                                    <div class="col-md-4 searchpart">
                                        <div class="row">
                                            <div class="col-md-12 label">
                                                <img style="height:250px;width:100%;" src="<?php echo $image; ?>" class="img-responsive">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class='col-md-12 cont text-left'>
                                                <h4><a style="text-decoration:none;" href='noteview.php?noteid=<?php echo $noteid; ?>'><?php echo $title; ?></a></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src='images/Front_images/images/university.png'>
                                            </div>
                                            <div class="col-md-10 text-left">
                                                <p><?php echo $university; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="images/Front_images/images/pages.png">
                                            </div>
                                            <div class="col-md-10 text-left">
                                                <p><?php echo $noofpage; ?> Pages</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src='images/Front_images/images/date.png'>
                                            </div>
                                            <div class="col-md-10 text-left">
                                                <p><?php echo $date; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class='col-md-2'>
                                                <img src='images/Front_images/images/flag.png'>
                                            </div>
                                            <div class='col-md-10 text-left'>
                                                <p style="color:red;">
                                                
                                                <?php 
                                                    $result=mysqli_query($connection,"SELECT * FROM sellernotesreport WHERE noteid='$noteid'");
                                                    echo mysqli_num_rows($result);
                                                    
                                                    ?> Users marked this note as inappropriate</p>
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
                                                        $result=mysqli_query($connection,"SELECT * FROM sellernotesview WHERE noteid='$noteid'");
                                                        echo mysqli_num_rows($result);
                                                    ?> Reviews</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php    
                                    
                                }
                                
                            ?>
                            
                            <!--<div class="text-center" aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="disabled"><a href="#">«</a></li>
                                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div>-->
                           
                       </div>
                      
                    </div>
        
                </div>
        
            </div>
        
        </section>


<!-- pagination start -->
<div class="search-pagination text-center">
    <ul class="pagination justify-content-center">
        <?php
        echo "<li class='page-item'><a onclick=" . "showNotes($page-1)" . " class='page-link' >❮</a></li>";
        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $page) {
                echo "<li class='page-item active'><a class='page-link' onclick=" . "showNotes($i)" . ">$i</a></li>";
            } else echo "<li class='page-item'><a class='page-link' onclick=" . "showNotes($i)" . ">$i</a></li>";
        }
        echo "<li class='page-item'><a onclick=" . "showNotes($page+1)" . " class='page-link'>❯</a></li>";
        ?>
    </ul>
</div>
<!-- pagination end -->