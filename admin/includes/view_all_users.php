<?php
if(!isset($_SESSION["user_name"])){
        header("Location:../entry.php");
}
?>

                        <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                        
                         <th>Username</th>
                         <th>Firstname</th>
                         <th>Lastname</th>
                         <th>Email</th>
                         <th>Role</th>
                       
                        </tr>    
                        </thead>
                            <tbody>
                            <?php
                            $query="select * from users";
                            $select_users=mysqli_query($connection,$query);
                            while($row=mysqli_fetch_assoc($select_users)){
                         $user_id=$row["user_id"];
                         $user_name=$row["user_name"];
                         $user_password=$row["user_password"];
                         $user_firstname=$row["user_firstname"];
                         $user_lastname=$row["user_lastname"];
                         $user_email=$row["user_email"];
                         $user_role=$row["user_role"];
                                echo "<tr>";
                                echo "<td> $user_name</td>";
                                echo "<td> $user_firstname</td>";
                                echo "<td> $user_lastname</td>";
                                 
        /*$query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
        $select_post_id_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_post_id_query)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
            
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        
        
        }*/
                                echo "<td> $user_email</td>";
                                echo "<td> $user_role</td>";
                                if($_SESSION["user_name"]==$user_name){
                                echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
                                echo "<td><a href='users.php?change_to_subscriber=$user_id'>Subscriber</a></td>";
                                  echo "<td><a href='users.php?source=edit_users&edit_users=$user_id'>Edit</a></td>";
                                echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                            
                            
                                
                            </tbody>
                        </table>
<?php
if(isset($_GET["change_to_admin"])){
    $change_to_admin=$_GET["change_to_admin"];
    $query="UPDATE  users set user_role='Admin' where user_id=$change_to_admin";
    $change_query1=mysqli_query($connection,$query);
    header("Location:users.php");
    if(!$change_query1){
        die("query failed".mysqli_error($connection));
    }
}



if(isset($_GET["change_to_subscriber"])){
    $change_to_subscriber=$_GET["change_to_subscriber"];
    $query="UPDATE  users set user_role='Subscriber' where user_id=$change_to_subscriber";
    $change_query2=mysqli_query($connection,$query);
    header("Location:users.php");
    if(!$change_query2){
        die("query failed".mysqli_error($connection));
    }
}


if(isset($_GET["delete"])){
    if(isset($_SESSION["user_role"])){
        
    if($_SESSION["user_role"]=="Admin"){
    $user_id=mysqli_real_escape_string($connection,$_GET["delete"]);
    $query="delete from users where user_id={$user_id}";
    $delete_query=mysqli_query($connection,$query);
    header("Location:users.php");
    if(!$delete_query){
        die("query failed".mysqli_error($connection));
    }
    }
    }
}
?>