<div id="bioupdate" class="overlay">
	   <div id="bio_update" class="popup">
     <div id="exit_button_wrapper">
        <a class="exit_button" href="#">X</a>
     </div>
     <h2>Update Description</h2>
        
        <form method="post">
            <div class="form_wrapper">
                <img class="profile_img spin" src="<?php echo $_SESSION["user"]["emp_avatar"];?>"/>
                <?php
                echo "<textarea name='description' maxlength='". POST_MAX . "'autofocus></textarea>";
                ?>
            </div>
            <div id="bio_button_wrapper">
                <button id="post_button" type="submit" name="post">Post</button>
            </div>
          </form>
            
            <?php 
            $error = false;
            if (isset($_POST['description']) && empty($_POST['description'])) {
                $error = true;
              }
              if ($error) {              
                echo "<p class='hidden_messages'>Cannot Submit Empty Post.</p>";
              } else {
                          
            if(isset($_POST['description'])){

              $bio_text = explode(" ", $_POST['description']);


// BAD WORD FILTER

            function badWordsFilter($inputWord) {
              foreach ($inputWord as $inputWord) {
                $badWords = explode("\n", file_get_contents('badwords.txt'));
                 for($i=0;$i<count($badWords);$i++) {
                   if($badWords[$i] == strtolower($inputWord))
                      return true;
                   }
                return false;
              }
            }
               
              if (badWordsFilter($bio_text)) {
                  echo "<p class='hidden_messages'>LETS KEEP THIS PG</p>";
              } else {
                  
// POST SENT TO DB

                User::update_bio($_POST['description']);
                echo "<script> location.href='?page=profile'; </script>";

                }
            }
         }

    ?>




        </div>
</div>