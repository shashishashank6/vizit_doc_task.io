<?php
if(!isset($_SESSION["user_name"])){
        header("Location:../entry.php");
}
?>

<?php 

                        /*EDITING FROM*/
                        if(isset($_SESSION["user_name"])){
                        if(isset($_GET["p_id"])){
                         $the_post_id=mysqli_real_escape_string($connection,$_GET["p_id"]);
                         $query="select * from posts where post_id=$the_post_id";
                         $select_posts_by_id=mysqli_query($connection,$query);
                        if(!$select_posts_by_id){
                            die("query failed".mysqli_error($connection));
                        }
                         while($row=mysqli_fetch_assoc($select_posts_by_id)){
                         $post_id=mysqli_real_escape_string($connection,$row["post_id"]);
                         $post_author=$row["post_author"];
                         $post_title=$row["post_title"];
                         $post_category_id=$row["post_category_id"];
                         $post_status=$row["post_status"];
                         $post_image=$row["post_image"];
                         $post_content=$row["post_content"];
                         $post_tags=$row["post_tags"];
                         $post_comment_count=$row["post_comment_count"];
                         $post_date=$row["post_date"];
                         }
                        }
}
                               /*UPDATING*/
                        if(isset($_POST["update_post"])){
                             $post_user=escape($_POST["post_author"]);
                             $post_title=escape($_POST["post_title"]);
                             $post_category_id=escape($_POST["post_category_id"]);
                             $post_status=escape($_POST["post_status"]);
                             $post_image=$_FILES["image"]["name"];
                             $post_image_temp=$_FILES["image"]["tmp_name"];
                             $post_tags=escape($_POST["post_Tags"]);
                             $post_content=escape($_POST["post_Content"]);
                             move_uploaded_file($post_image_temp, "../images/$post_image");
                              if(empty($post_image)){
                                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                                    $select_image = mysqli_query($connection,$query);

                                    while($row = mysqli_fetch_array($select_image)) {

                                       $post_image = $row['post_image'];

                                    }
                              }
                              $query= "UPDATE posts SET ";
                              $query .="post_title  = '{$post_title}', ";
                              $query .="post_category_id = '{$post_category_id}', ";
                              $query .="post_date   =  now(), ";
                              $query .="post_author = '{$post_user}', ";
                              $query .="post_status = '{$post_status}', ";
                              $query .="post_tags   = '{$post_tags}', ";
                              $query .="post_content= '{$post_content}', ";
                              $query .="post_image  = '{$post_image}' ";
                              $query .= "WHERE post_id = {$the_post_id} ";

                            $update_post = mysqli_query($connection,$query);
                            if(! $update_post){
                               die("query failed".mysqli_error($connection)); 
                            }
                            echo "<p class='bg-success'> Post Updated <a href='../post.php?p_id={$the_post_id}'>View Post</a> 
                            <a href='posts.php'>Edit More Posts</a>
                            </p>";
        
                                    }
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="title">Post Title</label> 
<input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
</div>
    
    <div class="form-group">
    <select name="post_category" id="">
    <?php
    $query="select * from categories where cat_id";
    $select_categories=mysqli_query($connection,$query);
    if(!$select_categories){
        die("query failed".mysqli_error($connection));
    }
    while($row=mysqli_fetch_assoc( $select_categories)){
        $cat_id=$row["cat_id"];
        $cat_title=$row["cat_title"];
        
        echo "<option value='$cat_id'>$cat_title</option>";
    }
    ?>
    </select>
    </div>
<div class="form-group">
<label for="post_categoryIId">Post Category Id</label> 
<input  value="<?php echo $post_category_id; ?>" type="text" class="form-control" name="post_category_id">
</div>
    
<div class="form-group">
<label for="post_author">Post Author</label> 
<input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
</div>
    <div class="form-group">
    <select name="post_status" id="">
    <option value="<?php echo $post_status; ?>">
        <?php echo $post_status; ?>
    </option>
        <?php
        if($post_status=="Publishing"){
            echo "<option value='draft'>Draft</option>"; 
        }
        else{
             echo "<option value='Publishing'>Publishing</option>";
        }
        ?>
    </select>
    </div>

    
<div class="form-group">
<img width="100" src="../images/<?php echo $post_image; ?>">
<input type="file"  name="image">
</div>
    
<div class="form-group">
<label for="post_tags">Post Tags</label> 
<input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_Tags">
</div>
    
<div class="form-group">
<label for="post_content">Post Content</label> 
    <textarea  type="text" class="form-control" name="post_Content" cols="30" id=""> <?php echo  $post_content; ?> </textarea>
</div>
    
<div class="form-group">
<input type="submit" class="btn btn-primary" name="update_post" value="Update Post">    
</div>
</form>