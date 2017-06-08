<?php
if(!isset($_SESSION["user_name"])){
        header("Location:../entry.php");
}
?>


<?php
if(isset($_GET["edit_users"])){
                         $edit_user=escape($_GET["edit_users"]);
                         $query="select * from users where user_id=$edit_user";
                         $select_users_by_id=mysqli_query($connection,$query);
                        if(!$select_users_by_id){
                            die("query failed".mysqli_error($connection));
                        }
                         while($row=mysqli_fetch_assoc($select_users_by_id)){
                         $user_id=$row["user_id"];
                         $user_firstname=$row["user_firstname"];
                         $user_lastname=$row["user_lastname"];
                         $user_role=$row["user_role"];
                         $user_name=$row["user_name"];
                         $user_email=$row["user_email"];
                         $user_password=$row["user_password"];
                         $user_image=$row["user_image"];
                         }
                        }
                          if(isset($_POST["update_user"])){
                               $user_firstname=escape($_POST["user_firstname"]);
                               $user_lastname=escape($_POST["user_lastname"]);
                               $user_role=escape($_POST["user_role"]);
                               $user_name=escape($_POST["user_name"]);
                               $user_email=escape($_POST["user_email"]);
                               $user_password=escape($_POST["user_password"]);
                              
                               $query="select randsalt from users";
                               $query_randsalt=mysqli_query($connection,$query);
                               if(!$query_randsalt){
                                   die("query failed".mysqli_error($connection));
                               }
                              
                              $row=mysqli_fetch_array($query_randsalt);
                              $salt=$row["randsalt"];
                              $hashed_password=crypt($user_password,$salt);

                              $query = "UPDATE users SET ";
                              $query .="user_firstname  = '{$user_firstname}', ";
                              $query .="user_lastname = '{$user_lastname}', ";
                              $query .="user_role   =  '{$user_role}', ";
                              $query .="user_name = '{$user_name}', ";
                              $query .="user_email = '{$user_email}', ";
                              $query .="user_password   = '{$hashed_password}' ";
                              $query .= "WHERE user_id = {$edit_user} ";
       
                              $edit_user_query=mysqli_query($connection,$query);
                              if(!$edit_user_query){
                                  die("query failed".mysqli_error($connection));
                              }
                              echo "<p class='bg-success'>Successfully Updated</p> ";
                          }
                              

?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
     
      <div class="form-group">
         <label for="title">Firstname</label>
          <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
      </div>
      
      
      

       <div class="form-group">
         <label for="post_status">Lastname</label>
          <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
      </div>
     
     
         <div class="form-group">
       
       <select name="user_role" id="">
        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
           <?php
           if($user_role=="Admin"){
              echo '<option value="subscriber">Subscriber</option>'; 
           }
           else{
                echo '<option value="admin">Admin</option>';
         
           }
           
           ?>
         
           
       
       </select>
       
       
       
       
      </div>
      
<!--
      <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>
-->

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input value="<?php echo $user_name; ?>" type="text" class="form-control" name="user_name">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password">
      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
      </div>


</form>
    
