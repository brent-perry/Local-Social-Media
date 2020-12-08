<?php
if (!User::is_admin())
{
	header("Location: ?page=profile");
	die();
	}
?>

<div class="act_deact">
	<h3>Deactivate User by Employee ID</h3>
	<div class="act_deact_user">
    <form method="post">
        <div class="form_wrapper">
            <?php
            echo "<textarea name='deactivate_user_byID' maxlength='20' autofocus></textarea>";
            ?>
        </div>
        <div class="act_deact_button_wrapper">
            <button class="act_deact_button" type="submit" name="post">Deactivate</button>
        </div>
        
        <?php 
        $error = false;
        if (isset($_POST['deactivate_user_byID']) && empty($_POST['deactivate_user_byID'])) {
            $error = true;
          }
          if ($error) {              
            echo "<p class='hidden_messages'>Cannot Submit Empty Query.</p>";
          } else {
                      
        if(isset($_POST['deactivate_user_byID'])){

          $deactivate_user_byID = explode(" ", $_POST['deactivate_user_byID']);

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
            
          if (badWordsFilter($deactivate_user_byID)) {
              echo "<p class='hidden_messages'>LETS KEEP THIS PG</p>";
          } else {
              
// POST SENT TO DB

            User::deactivate_user_byID($_POST['deactivate_user_byID']);
    
            echo "<p class='hidden_messages'>User '". $_POST['deactivate_user_byID'] ."' Has Been Deactivated.</p>";
            $log = Log::get_instance();
            $log->write($user_ip .' : ' . $_SESSION['user']['emp_id'] . ' : DEACTIVATE USER '. $_POST['deactivate_user_byID']);
      
            }
        }
      }

    ?>
	    </form>
  </div>
</div>

<div class="act_deact">
	<h3>Deactivate User by Username</h3>
	<div class="act_deact_user">
    <form method="post">
        <div class="form_wrapper">
            <?php
            echo "<textarea name='deactivate_user' maxlength='20' autofocus></textarea>";
            ?>
        </div>
        <div class="act_deact_button_wrapper">
            <button class="act_deact_button" type="submit" name="post">Deactivate</button>
        </div>
        
        <?php 
        $error = false;
        if (isset($_POST['deactivate_user']) && empty($_POST['deactivate_user'])) {
            $error = true;
          }
          if ($error) {              
            echo "<p class='hidden_messages'>Cannot Submit Empty Query.</p>";
          } else {
                      
        if(isset($_POST['deactivate_user'])){

          $deactivate_user = explode(" ", $_POST['deactivate_user']);


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
            
          if (badWordsFilter($deactivate_user)) {
              echo "<p class='hidden_messages'>LETS KEEP THIS PG</p>";
          } else {
              
// POST SENT TO DB

            User::deactivate_user($_POST['deactivate_user']);
    
            echo "<p class='hidden_messages'>User '". $_POST['deactivate_user'] ."' Has Been Deactivated.</p>";
            $log = Log::get_instance();
            $log->write($user_ip .' : ' . $_SESSION['user']['emp_id'] . ' : DEACTIVATE USER '. $_POST['deactivate_user']);
      
            }
        }
      }

    ?>
	    </form>
  </div>
</div>

<div class="act_deact" >
	  <h3>Activate User by Username</h3>
	<div class="act_deact_user" >
	  <form method="post">
            <div class="form_wrapper">
                <?php
                echo "<textarea name='activate_user' maxlength='20' autofocus></textarea>";
                ?>
            </div>
            <div class="act_deact_button_wrapper">
                <button class="act_deact_button" type="submit" name="post">Activate</button>
            </div>
            
            <?php 
            $error = false;
            if (isset($_POST['activate_user']) && empty($_POST['activate_user'])) {
                $error = true;
              }
              if ($error) {              
                echo "<p class='hidden_messages'>Cannot Submit Empty Query.</p>";
              } else {
                          
            if(isset($_POST['activate_user'])){

              $activate_user = explode(" ", $_POST['activate_user']);


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
               
              if (badWordsFilter($activate_user)) {
                  echo "<p class='hidden_messages'>LETS KEEP THIS PG</p>";
              } else {
                  
// POST SENT TO DB

                User::activate_user($_POST['activate_user']);
				
				echo "<p class='hidden_messages'>User '". $_POST['activate_user'] ."' Has Been Activated.</p>";
				$log = Log::get_instance();
				$log->write($user_ip .' : ' . $_SESSION['user']['emp_id'] . ' : ACTIVATE USER '. $_POST['activate_user']);
				
                }
            }
         }

    ?>
	  </form>

</div>

<div class="act_deact" >
	<h3>Activate User by Employee ID</h3>
	<div class="act_deact_user" >
	  <form method="post">
            <div class="form_wrapper">
                <?php
                echo "<textarea name='activate_user_byID' maxlength='20' autofocus></textarea>";
                ?>
            </div>
            <div class="act_deact_button_wrapper">
                <button class="act_deact_button" type="submit" name="post">Activate</button>
            </div>
            
            <?php 
            $error = false;
            if (isset($_POST['activate_user_byID']) && empty($_POST['activate_user_byID'])) {
                $error = true;
              }
              if ($error) {              
                echo "<p class='hidden_messages'>Cannot Submit Empty Query.</p>";
              } else {
                          
            if(isset($_POST['activate_user_byID'])){

              $activate_user_byID = explode(" ", $_POST['activate_user_byID']);


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
               
              if (badWordsFilter($activate_user_byID)) {
                  echo "<p class='hidden_messages'>LETS KEEP THIS PG</p>";
              } else {
                  
// POST SENT TO DB

                User::activate_user_byID($_POST['activate_user_byID']);
				
				echo "<p class='hidden_messages'>User '". $_POST['activate_user_byID'] ."' Has Been Activated.</p>";
				$log = Log::get_instance();
				$log->write($user_ip .' : ' . $_SESSION["user"]["emp_id"] . ' : ACTIVATE USER '. $_POST['activate_user_byID']);
				
                }
            }
         }

    ?>
	  </form>

</div>

