<div class="nav">
    <ul>
        <li class="<?php if($page == 'homepage'){echo 'active';} ?>"><a href="?page=homepage">Home</a></li>

        <li class="<?php if($page == 'post'){echo 'active';} else if(!User::is_logged_in()){echo 'hide';}else echo '';
       ?>"><a href="?page=post">Posts</a></li>

        <li class="<?php if($page == 'profile'){echo 'active';} else if(!User::is_logged_in()){echo 'hide';}else echo '';
       ?>"><a href="?page=profile">Profile</a></li>

        <li class="<?php if ($page == 'login'){echo 'active';} else if(User::is_logged_in()){echo 'hide';}else echo '';
       ?>"><a href="?page=login">Login</a></li>
  

        <li class="<?php if($page == 'register'){echo 'active';} else if(User::is_logged_in()){echo 'hide';}else echo '';
       ?>"><a href="?page=register">Register</a></li>

       <li class="<?php if($page == 'admin'){echo 'active';} else if(!User::is_logged_in() || !User::is_admin()){echo 'hide';}else echo '';
       ?>"><a href="?page=admin">Admin</a></li>

        <li class="<?php if(User::is_logged_in()){echo 'show';} else echo 'hide';?>"><a href="?page=logout">Logout</a></li>


        
    </ul>
</div>

