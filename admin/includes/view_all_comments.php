<?php
if(!isset($_SESSION["user_name"])){
        header("Location:../entry.php");
}
?>

                        <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                        
                         <th>Author</th>
                         <th>Comment</th>
                         <th>Email</th>
                         <th>Status</th>
                         <th>In Response to</th>
                        <th>Date</th>
                         <th>Approve</th>
                         <th>Unapprove</th>
                         <th>Delete</th>
                          
                        </tr>    
                        </thead>
                            <tbody>
                            <?php
                            $query="select * from comments";
                            $select_comments=mysqli_query($connection,$query);
                            while($row=mysqli_fetch_assoc($select_comments)){
                         $comment_id=$row["comment_id"];
                         $comment_post_id=$row["comment_post_id"];
                         $comment_author=$row["comment_author"];
                         $comment_content=$row["comment_email"];
                         $comment_email=$row["comment_content"];
                         $comment_status=$row["comment_status"];
                         $comment_date=$row["comment_date"];
                                echo "<tr>";
            
                                echo "<td> $comment_author</td>";
                                echo "<td>$comment_email</td>";
                                echo "<td>$comment_content</td>";
                                echo "<td>$comment_status</td>";
                                 
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
        $select_post_id_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_post_id_query)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
            
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        
        
        }
                                echo "<td>$comment_date</td>";
                                echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                                echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                                
                                echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
                                echo "</tr>";
                            }
                            ?>
                            
                            
                                
                            </tbody>
                        </table>
<?php
if(isset($_GET["approve"])){
    $comment_approve=$_GET["approve"];
    $query="UPDATE  comments set comment_status='approved' where comment_id=$comment_approve";
    $approve_query=mysqli_query($connection,$query);
    header("Location:comments.php");
    if(!$approve_query){
        die("query failed".mysqli_error($connection));
    }
}



if(isset($_GET["unapprove"])){
    $comment_unapprove=$_GET["unapprove"];
    $query="UPDATE  comments set comment_status='unapproved' where comment_id=$comment_unapprove";
    $unapprove_query=mysqli_query($connection,$query);
    header("Location:comments.php");
    if(!$unapprove_query){
        die("query failed".mysqli_error($connection));
    }
}


if(isset($_GET["delete"])){
    $comment_id=$_GET["delete"];
    $query="delete from comments where comment_id={$comment_id}";
    $delete_query=mysqli_query($connection,$query);
    header("Location:comments.php");
    if(!$delete_query){
        die("query failed".mysqli_error($connection));
    }
}
?>