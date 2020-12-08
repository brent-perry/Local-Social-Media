<!-- FORM TO CREATE POST -->

<div class="post_container">
    <div class="mini_emp_profile"></div>
        <div class="post">	
            <form method="post">
                <div class="form_wrapper">
                    <img class="profile_img" src="<?php echo $_SESSION["user"]["emp_avatar"];?>"/>
                    <?php
                    echo "<textarea onkeyup='adjustHeight(this)' name='posttext' maxlength='". POST_MAX . "'></textarea>";
                    ?>
                
                </div>
                    <button id="post_button" type="submit" name="post">Post</button>
                
            </form>
            <?php 

            $error = false;
            if (isset($_POST['posttext']) && empty($_POST['posttext'])) {
                $error = true;
              }
              if ($error) {
                echo "Cannot Submit Empty Post.";
              } else {
                          
            if(isset($_POST['posttext'])){


// BAD WORD FILTER

            function badWordsFilter($inputWord) {
                $badWords = explode("\n", file_get_contents('badwords.txt'));
                 for($i=0;$i<count($badWords);$i++) {
                   if($badWords[$i] == strtolower($inputWord))
                      return true;
                   }
                return false;
              }
               
              if (badWordsFilter($_POST['posttext'])) {
                  echo "<p id='register_p'>LETS KEEP THIS PG</p>";
              } else {
                  echo "<p id='register_p'>POSTED!</p>";

                  
// POST SENT TO DB

                $pdo = Database::get_pdo();

                $statement = $pdo->prepare("INSERT INTO posts(post_text,post_emp_id,post_visible) VALUES(?,?,1);");
                $statement->execute([ $_POST['posttext'] , $_SESSION["user"]["emp_id"] ]);

                }
            }
         }

    ?>
        <div class="post_button_div">
        </div>
    </div>
    </div>


<!-- POSTS DISPLAYED ON THE PAGE -->


    <div class="post_list_container">

    <?php


    if (isset($_GET['page_no']) && $_GET['page_no']!="") {
        $page_no = $_GET['page_no'];
        } else {
            $page_no = 1;
            }

    $con = mysqli_connect("127.0.0.1:8889","root","root","pbj");
    if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
    }


    $total_records_per_page = 10;

    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";


    $result_count = mysqli_query(
        $con,
        "SELECT COUNT(*) As total_records FROM `posts`"
        );
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total pages minus 1

        $result = mysqli_query(
            $con,
            "SELECT `emp_username`,`emp_avatar`,`post_timestamp`,`post_text`,`post_visible` FROM `posts` LEFT JOIN `employees` ON `posts`.`post_emp_id` = `employees`.`emp_id` WHERE `post_visible` = 1 ORDER BY `post_timestamp` DESC LIMIT $offset, $total_records_per_page"
            );
        while($row = mysqli_fetch_array($result)){
            $now = new DateTime();
            $post_date = new DateTime($row['post_timestamp']);
            $diff = $now -> diff($post_date);

            $days = $diff->days;
            if 	($days < 1) {
                $timelate = ($diff->h . " hours");
                if 	($diff->h < 1) {
                    $timelate = ($diff->i . " minutes");}}
            else $timelate = ($days . " days");

            echo "<div class='post_content'><div class='avatar'><img class='profile_img' src='" . $row['emp_avatar'] . "'></div>";
            echo "<div class='post_username'>" . $row['emp_username'];
            echo "<div class='post_timestamp'>" . $timelate . " ago</div></div><button class='post_delete' type='submit' name='delete'><img class='delete_icon' src='images/delete_icon.png'/></button>";
            echo "<div class='post_text'>" . $row['post_text'] . "</div></div>";

        }
        mysqli_close($con);

?>

</div>

<div class="page_numbers">
<p>Page <?php echo $page_no." of ".$total_no_of_pages; ?></p>
</div>

<ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page=post&page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?page=post&page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page=post&page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page=post&page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page=post&page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page=post&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page=post&page_no=1'>1</a></li>";
		echo "<li><a href='?page=post&page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page=post&page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page=post&page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page=post&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page=post&page_no=1'>1</a></li>";
		echo "<li><a href='?page=post&page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page=post&page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) { echo "href='?page=post&page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?page=post&page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>


</div>

<a href="#title" id="to_top">&#8679;</a>