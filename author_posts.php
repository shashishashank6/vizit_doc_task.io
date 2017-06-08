<?php
include "includes/db.php";
?>
<?php
if(isset($_SESSION["user_role"])){
    header("Location:entry.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">
     <link href="css/loader.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   
                    <li>
                        <a href="admin">Admin</a>
                    </li>
                  <!--  <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                        <?php
                                if(isset($_GET["p_id"])){
                                    
                                $the_post_id=$_GET["p_id"];
                                 $the_post_author=$_GET["author"];
                                
                        $query="select * from posts WHERE post_author='{$the_post_author}'";
                        $select_all_posts=mysqli_query($connection,$query);
                         while($row=mysqli_fetch_assoc($select_all_posts)){
                        $post_title=$row["post_title"];
                         $post_author=$row["post_author"];
                         $post_date=$row["post_date"];
                         $post_image=$row["post_image"];
                         $post_content=$row["post_content"];
                         
                         ?>
                <!--kept in a loop to repeat-->
                         <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>



                   <?php 
                                }
                                
                
                ?>
               
                

                <hr>

                
                
                
                <!-- Blog Comments -->

                <!-- Comments Form -->
                <?php
                if(isset($_POST["create_comment"])){
                    
                    $the_post_id=$_GET["p_id"];
                
                    $author=$_POST["comment_name"];
                    $email=$_POST["comment_email"];
                    $your_comment=$_POST["your_comment"];
                   $query="insert into comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) values('{$the_post_id}','{$author}','{$email}','{$your_comment}','unapproved',now())";
                    
                    $create_comment=mysqli_query($connection,$query);
                       if(!$create_comment){
                           die("query failed".mysqli_error($connection));
                       }                    
                
                
                $query="update posts set post_comment_count=post_comment_count+1 where post_id=$the_post_id";
                $update_comment_count=mysqli_query($connection,$query);
                }
                                
                ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                           <div class="form-group">
                               <label for="author">Author</label>
                           <input type="text" name="comment_name" class="form-control" id="author" required>
                        </div>
                           <div class="form-group">
                               <label for="email">Email</label>
                            <input type="text" name="comment_email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea class="form-control" rows="3" id="comment" name="your_comment" required></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" name="create_comment" value="Submit">
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                 
                $query="select * from comments where comment_post_id=$the_post_id and comment_status='approved' order by comment_id desc";
                $comment_query=mysqli_query($connection,$query);
                while($row=mysqli_fetch_assoc($comment_query)){
                    $comment_date=$row["comment_date"];
                    $comment_content=$row["comment_content"];
                    $comment_author=$row["comment_author"];
                
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                <?php 
                }
                                }
            ?>
                
            
                <!-- Comment -->
            

                
                
                

                
                <!-- Pager -->
               

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
<?php
           /*    if(isset($_POST["submit"])){
                    echo $search=$_POST["search"];
                  /*$query="select * from Posts WHERE post_tags LIKE '%$search%'";
                    $search_query=mysqli_query($connection,$query);
                    if(!$search_query){
                        die("query failed".mysqli_error($connection));
                    }
                    $count=mysqli_num_rows($search_query);
                    if($count==0){
                        echo "<h1>no result sorry!</h1>";
                    }
                    else{
                     
                    
                    }
                }
                */
                    ?>
                         
                
                        
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form><!---search form--->
                    <!-- /.input-group -->
                </div>

                
                
                <!-- Blog Categories Well -->
                <div class="well">
                    <?php
                    $query="select * from categories";
                    $select_categories=mysqli_query($connection,$query);
                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                while($row=mysqli_fetch_assoc($select_categories)){
                        $cat_title=$row["cat_title"];
                        echo "<li><a href='#'>{$cat_title}</a></li>";
                    }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
               

            </div>

        </div>
        <!-- /.row -->

        <hr>
    
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2017</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
 