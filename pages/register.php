<?php
require 'policy.php';
?>


<div class="master_register_container">
    <div class="register_container">
        <div class="register_info">
            <form method="post" class="register_input_container">
                <input class="register_input" type="text" name="first_name" placeholder="First Name" autocomplete="off"></input>
                <input class="register_input" type="text" name="last_name" placeholder="Last Name" autocomplete="off"></input>
                <input class="register_input" type="text" name="username" placeholder="Username" autocomplete="off"></input>
                <input class="register_input" type="text" name="employee_id" placeholder="Employee ID" autocomplete="off"></input>
                <p class="register_input">Department</p>
                <select class="register_input" id="department_selector" name="emp_dept_id">
                    <option value="1">Administration</option>
                    <option value="2">Call Centre</option>
                    <option value="3">IT</option>
                    <option value="4">Pharmacy</option>
                </select> 
                <input class="register_input" type="password" name="password" placeholder="Password" autocomplete="off"></input>
                <input class="register_input" type="password" name="confirm_password" placeholder="Confirm Password" autocomplete="off"></input>

                <div class="policy_agree">
                <button id="register_button" type="submit" name="register">Sign up</button>
                <p>By signing up, you accept the <a href=#policy> Usage Policy</a></p>
                </div>
            </form>
        </div>
    </div>

  
</div>


<?php

require 'internal/database.php';

if (isset($_POST['first_name']) && isset($_POST['password']) && isset($_POST['last_name']) && isset($_POST['username']) && isset($_POST['employee_id'])&& isset($_POST['emp_dept_id']) && isset($_POST['confirm_password']))
{

    $register_first = explode(" ", $_POST['first_name']);
    $register_last = explode(" ", $_POST['last_name']);
    $register_user = explode(" ", $_POST['username']);

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
   
  if (badWordsFilter($register_first,$register_last,$register_user)) {
        echo "<p class='hidden_messages'>LETS KEEP THIS PG</p>";
  } else {

    // POST SENT TO DB


  User::register();
}
}
 ?>
