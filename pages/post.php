<?php
if ($_SESSION['user'] == null){
	header("Location: ?page=login");
	die();
    }

$emp_id = $_SESSION["user"]["emp_id"];
    
    



?>


<!-- FORM TO CREATE POST -->

<div class="post_container">
    <div class="mini_emp_profile"></div>
        <div class="post">	
            <form method="post">
                <div class="form_wrapper">
                    <img class="profile_img" src="<?php echo $_SESSION["user"]["emp_avatar"];?>"/>
                    <?php
                    echo "<textarea name='posttext' maxlength='". POST_MAX . "'autofocus></textarea>";
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
                echo "<p class='hidden_messages'>Cannot Submit Empty Post.</p>";
              } else {
                          
            if(isset($_POST['posttext'])){

            $post_text = explode(" ", $_POST['posttext']);
            

// BAD WORD FILTER

            function badWordsFilter($inputWord) {
                foreach ($inputWord as $inputWord) {
                $badWords = explode("\n", file_get_contents('badwords.txt'));
                 for($i=0;$i<count($badWords);$i++) {
                   if($badWords[$i] == strtolower($inputWord))
                      return true;
                   } 
                }

                return false;
              }              
              if (badWordsFilter($post_text)) {

                  echo "<p class='hidden_messages'>LETS KEEP THIS PG</p>";

              } else {
                  echo "<p class='hidden_messages'>POSTED!</p>";

                  
// POST SENT TO DB


    User::send_post($_POST['posttext'] , $_SESSION["user"]["emp_id"]);
	header("Location: ?page=post");

            }
        }

	}

    ?>
        <div class="post_button_div">
        </div>
    </div>
    </div>
    <div class='post_list_container'>

<!-- POSTS DISPLAYED ON THE PAGE -->

    <?php

    if (isset($_GET['page_no']) && $_GET['page_no']!="") {
        $page_no = $_GET['page_no'];
        } else {
            $page_no = 1;
            }

    
    
    $total_records_per_page = 10;

    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";

    $result_count = User::get_post_count();

        $total_records = $result_count;
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total pages minus 1


    foreach (User::get_all_posts($offset,$total_records_per_page) as $row) {
            $now = new DateTime();
            $post_date = new DateTime($row['post_timestamp']);
            $diff = $now -> diff($post_date);

            $days = $diff->days;
            if 	($days < 1) {
                $timelate = ($diff->h . " hours");
                if 	($diff->h < 1) {
                    $timelate = ($diff->i . " minutes");}}
            else $timelate = ($days . " days");

            echo "<div id=".$row['id']." class='post_content'><div class='avatar_edit_delete_container'><div class='avatar'><img class='profile_img' src='" . $row['emp_avatar'] . "'></div>";
            echo "<div class='post_username'>" . $row['emp_username'];
            echo "<div class='post_timestamp'>" . $timelate . " ago</div></div>";


            if ((User::is_admin()) || ($row['emp_username'] == $_SESSION["user"]["emp_username"]))
            {
            echo "<div class='post_delete' id='post_delete_container'></div><a href='?page=delete&id=".$row['id']."'><img class='delete_icon icons' src='images/delete_icon.png'/></a>";}
            else {};
            echo "</div><div class='post_text'>" . $row['post_text'] . "</div><div class='post_link'><a href='?page=share&id=".$row['id']."'><img id='share_icon' class='icons' src='images/share_icon.png'/></a>";

            if ($row['post_likes'] == 1){
                $likes = " Like";
            }else{
                $likes = " Likes";
            }


            $results = User::user_liked($emp_id,$row['id']);
            if ($results == 1 ){
            echo "<div class='liked'><a href='?page=unlike&id=".$row['id']."'><img class='icons' id='thumbs_up' src='images/thumbs_up_icon.png'></a> ".$row['post_likes'].$likes."</div></div></div>";  

            } else {

            echo "<div class='unliked like_button_container'><a href='?page=like&id=".$row['id']."'><img class='icons like_button' id='thumbs_up' src='images/thumbs_up_icon.png'></a> ".$row['post_likes'].$likes."</div></div></div>";  
            }
    }
?>

</div>

<!-- PAGINATION -->
<div class="page_numbers">
<p>Page <?php echo $page_no." of ".$total_no_of_pages; ?></p>
</div>

<ul class="pagination">
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?page=post&page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 4){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page=post&page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 5){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 4; $counter++){		 
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
    
</ul>


</div>


