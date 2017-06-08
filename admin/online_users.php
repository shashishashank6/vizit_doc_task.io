<?php include "../includes/db.php"; ?>


<?php
        
    
                
                    $session=session_id();
            $time=time();
            $time_out_in_seconds=60;
            $time_out=$time-$time_out_in_seconds;
            $query="select * from users_online where session='$session'";
            $send_query=mysqli_query($connection,$query);
            $count=mysqli_num_rows($send_query);
            if($count==null){
                mysqli_query($connection,"insert into users_online(session,time) values('$session','$time')");
            }
            else{
                   mysqli_query($connection,"update  users_online set time='$time' where session='$session'");
                
            }
           $users_online_query= mysqli_query($connection,"select * from users_online where time>'$time_out'");
          echo  $count_users=mysqli_num_rows($users_online_query);

                
            
            ?>