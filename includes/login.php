<?php include "db.php"; ?>
<?php
session_start();
?>
<?php
if(!isset($_SESSION["user_name"])){
    header("Location:entry.php");
}
?>
<?php
$_SESSION["user_name"]="";
$_SESSION["user_time"]="";
$db_user_name="";
$db_user_password="";
if(isset($_POST["login"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $username=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);
    $query="select * from users where user_name='{$username}'";
    $select_user_query=mysqli_query($connection,$query);
    if(!$select_user_query){
        die("query failed".mysqli_error($connection));
    }
    while($row=mysqli_fetch_array($select_user_query)){
         $db_id=$row["user_id"];
        $db_user_name=$row["user_name"];
         $db_user_password=$row["user_password"];
         $db_firstname=$row["user_firstname"];
         $db_lastname=$row["user_lastname"];
         $db_user_role=$row["user_role"];
        
    }
    $password=crypt($password,$db_user_password);
        if($username===$db_user_name&&$password===$db_user_password){
         $_SESSION["user_name"]=$db_user_name;//setting session for username in the db
         $_SESSION["user_role"]=$db_user_role;
            if(isset($_SESSION["user_name"])){       
                $query="insert into login (user_logged_name,login_details) values('{$_SESSION["user_name"]}',now())";
                $time=mysqli_query($connection,$query);
                    if(!$time){
                        die("query failed".mysqli_error($connection));
                    }
                
                   }
            
        header("Location:../index.php");
    }
    else{
       echo $message="please enter correct username and password";
    }
                   
    
$db_time="";
  $query="select login_details from login where user_logged_name='{$username}'";
    $select_time=mysqli_query($connection,$query);
    if(!$select_time){
        die("query_failed".mysqli_error($connection));
    }
 while($row=mysqli_fetch_array($select_time)){
        $db_time=$row["login_details"];
     
    }  
                     $_SESSION["user_time"]=$db_time;//setting session for login in the db

}
?>
