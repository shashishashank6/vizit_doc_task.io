<?php

$name=$_SESSION["user_name"];
 $query="select login_id from login where user_logged_name='{$name}'";
    $select_id=mysqli_query($connection,$query);
    if(!$select_id){
        die("query_failed".mysqli_error($connection));
    }
 while($row=mysqli_fetch_array($select_id)){
         $db_id=$row["login_id"];
     
    }  
                     $_SESSION["login_id"]=$db_id;//setting session for login in the db
$id=$_SESSION["login_id"];
$query= "UPDATE  login SET  logout_time=NOW()  WHERE login_id=$id";
$logout_query=mysqli_query($connection,$query);
if(!$logout_query){
   die("query failed".mysqli_error($connection)); 
}


$query1="select login_details,logout_time from login where login_id=$id";
$duration_query=mysqli_query($connection,$query1);
while($row=mysqli_fetch_array($duration_query)){
    $db_login_time=$row["login_details"];
    $db_logout_time=$row["logout_time"];
    

}

$query2="UPDATE login SET log_duration=TIMEDIFF('$db_logout_time','$db_login_time')  WHERE login_id=$id";
$duration_result=mysqli_query($connection,$query2);
if(!$duration_result){
   die("query_failed".mysqli_error($connection)); 
}




    header("Location: logout.php");
?>