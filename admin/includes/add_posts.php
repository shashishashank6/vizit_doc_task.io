<?php
if(!isset($_SESSION["user_name"])){
header("Location:../entry.php");    
}
?>

<?php
if(isset($_POST["create_post"])){
                 $post_author=escape($_POST["post_author"]);
                 $post_title=escape($_POST["post_title"]);
                 $post_category_id=escape($_POST["post_category"]);
                 $post_status=escape($_POST["post_status"]);
                 $post_image=$_FILES["image"]["name"];
                 $post_image_temp=$_FILES["image"]["tmp_name"];
                 $post_content=escape($_POST["post_Content"]);
                 $post_date=date('d-m-y');
//                 $post_comment_count=4;
                 move_uploaded_file($post_image_temp, "../images/$post_image");
                  
    $query = "insert into posts(post_category_id, post_title, post_author, post_date,post_image,post_content,post_status) ";
             
      $query .= "values({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}', '{$post_status}') "; 
    
       $insert_query=mysqli_query($connection,$query);
       if(!$insert_query){
           die("query failed".mysqli_error($connection));
       }
        $the_post_id=mysqli_insert_id($connection);
         echo "<p class='bg-success'> Post Added <a href='../post.php?p_id={$the_post_id}'>View Post</a> 
                            <a href='posts.php'>Edit More Posts</a>
                            </p>";
}
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="title">Post Title</label> 
<input type="text" class="form-control" name="post_title">
</div>
  
<div class="form-group">
    <label for="cat">Categories</label> 
    <select name="post_category" id="">
    <?php
    $query="select * from categories";
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
<label for="post_author">Post Author</label> 
<input type="text" class="form-control" name="post_author">
</div>
    
    
<div class="form-group">
<label for="post_image">Post Image</label> 
<input type="file"  name="image">
</div>
    
<div class="form-group">
<label>Post Status</label>
<select name="post_status" id="">
    <option value="publish">Publish</option>
    <option value="draft">Draft</option>
</select>
</div>
    
<div class="form-group">
<label for="post_content">Post Content</label> 
    <textarea type="text" class="form-control" name="post_Content" cols="30" id=""></textarea>
</div>
    
<div class="form-group">
<input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">    
</div>
</form>