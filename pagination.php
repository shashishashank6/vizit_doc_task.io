<?php
include "includes/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">
    <link href="css/loaderstyle.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   
</head>

<body>
<div class="fakeloader"></div>
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
                    <?php
                    $query="select * from categories";
                    $select_all_categories=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($select_all_categories)){
                        $cat_title=$row["cat_title"];
                        echo "<li><a href='#'>{$cat_title}</a></li>";
                    }
                    ?>
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
                        $query="select * from Posts ";
                        $select_all_posts=mysqli_query($connection,$query);
                         while($row=mysqli_fetch_assoc($select_all_posts)){
                         $post_id=$row["post_id"];
                         $post_title=$row["post_title"];
                         $post_author=$row["post_author"];
                         $post_date=$row["post_date"];
                         $post_image=$row["post_image"];
                         $post_content=substr($row["post_content"],0,100);
                         $post_status=$row["post_status"];
                         ?>
                <!--kept in a loop to repeat-->
                         <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php  echo $post_id; ?>"> <?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo  $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                   <?php 
                             }
                ?>
                
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

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

                
               <!--login form-->
               
                <div class="well">
                    <h4>Log In</h4>
                    <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                         
                    </div>
                        <div class="input-group">
                        <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                         <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">Submit</button>
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
                        $cat_id=$row["cat_id"];
                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php
                include "widget.php";
                ?>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
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
     <script src="js/fakeLoader.min.js"></script>
    <script src="js/loader.js"></script>
    
</body>

</html>
