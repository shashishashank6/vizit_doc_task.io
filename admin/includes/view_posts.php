<?php
if(!isset($_SESSION["user_name"])){
        header("Location:../entry.php");
}
?>

<?php
                         if(isset($_POST["submit"])){
                        if(isset($_POST["checkBoxArray"])){
                        foreach($_POST["checkBoxArray"] as $checkBox_id){
                            $bulkoptions=$_POST["bulkoptions"];
                            switch($bulkoptions){
                                case "publish":
                                $query="update posts set post_status='{$bulkoptions}' where post_id=$checkBox_id ";
                                $update_publish=mysqli_query($connection,$query);
                                    if(!$update_publish){
                                        die("query failed".mysqli_error($connection));
                                    }
                                    break;
                                    case "draft":
                                $query="update posts set post_status='{$bulkoptions}' where post_id=$checkBox_id ";
                                $update_draft=mysqli_query($connection,$query);
                                    if(!$update_draft){
                                        die("query failed".mysqli_error($connection));
                                    }
                                    break;
                                    case "delete":
                                $query="DELETE FROM posts WHERE post_id={$checkBox_id}";
                                $delete=mysqli_query($connection,$query);
                                    if(!$delete){
                                        die("query failed".mysqli_error($connection));
                                    }
                                    break;
                            }
                        }
                        }
}


?>
                        
                        <form action="" method="post">
                        <table class="table table-hover table-bordered">
                        <div id="bulkOptionContainer" class="col-xs-4">
                            <select class="form-control" name="bulkoptions" id="">
                            <option value="">
                                Select Options
                            </option>
                                  <option value="publish">
                                Publish
                            </option>
                                  <option value="draft">
                                Draft
                            </option>
                                  <option value="delete">
                                Delete
                            </option>
                                
                            </select>
                        
                            
                       </div >
                            <div class="col-xs-4">
                            <input type="submit" class="btn btn-success" name="submit" value="Apply">
                                <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
                            </div>
                        
                            
                            <thead>
                            
                                
                                
                        <tr>
                        <?php
                        echo '<th><input type="checkbox" id="selectAllBoxes"></th>';
                            ?>
                
                         <th>Author</th>
                         <th>Title</th>
                         <th>Category</th>
                         <th>Status</th>
                         <th>Image</th>
                         <th>Tags</th>
                         <th>Comments</th>
                         <th>Date</th>
                        <th>View Post</th>
                        <th>Edit</th>
                         <th>Delete</th>
                        </tr>    
                        </thead>
                            <tbody>
                           
                            <?php
                            $query="select * from posts";
                            $select_posts=mysqli_query($connection,$query);
                            while($row=mysqli_fetch_assoc($select_posts)){
                         $post_id=mysqli_real_escape_string($connection,$row["post_id"]);
                         $post_author=$row["post_author"];
                         $post_title=$row["post_title"];
                         $post_category_id=$row["post_category_id"];
                         $post_status=$row["post_status"];
                         $post_image=$row["post_image"];
                         $post_tags=$row["post_tags"];
                         $post_comment_count=$row["post_comment_count"];
                         $post_date=$row["post_date"];
                                echo "<tr>";
                        ?>
                                <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>;
                            <?php
            
                                echo "<td> $post_author</td>";
                                echo "<td>$post_title</td>";
                                $query="select cat_title from categories where cat_id={$post_category_id}";
                                $select_result=mysqli_query($connection,$query);
                                if(!$select_result){
                                    die("query failed".mysqli_error($connection));
                                }
                                 while($row=mysqli_fetch_assoc($select_result)){
                                $cat_title=$row["cat_title"];
                                echo "<td> {$cat_title} </td>";
                                 }
                                
                                echo "<td> $post_status</td>";
                                echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
                                echo "<td>$post_tags</td>";
                                echo "<td>$post_comment_count</td>";
                                echo "<td>$post_date</td>";
                                 echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \"href='posts.php?delete={$post_id}'>Delete</a></td>";
                                echo "</tr>";
                            }
                            ?>
                            
                            
                                
                            </tbody>
                        </table>
</form>

<?php
if(isset($_SESSION["user_name"])){
if(isset($_GET["delete"])){
    $delete_post=mysqli_real_escape_string($_GET["delete"]);
    $query="delete from posts where post_id={$delete_post}";
    $delete_query=mysqli_query($connection,$query);
    header("Location:posts.php");
    if(!$delete_query){
        die("query failed".mysqli_error());
    }
}
}
?>