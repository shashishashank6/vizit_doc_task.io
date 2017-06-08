<?php ob_start(); ?>
<?php include "../includes/db.php";?>
<?php session_start(); ?>
<?php
if(!isset($_SESSION["user_role"])){
        header("Location:../entry.php");
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

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/loader.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a href="../index.php">HOME SITE</a></li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php
                        if(isset($_SESSION["user_name"])){
                            echo $_SESSION['user_name'];
                        }
                               ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php?src=logout_page"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="posts.php">View All Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add Post</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="active">
                        <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    <li>
                        <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comments</a>
                    </li>
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="users.php">View All Users</a>
                            </li>
                    
                        </ul>
                    </li>
                     <li>
                         <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i>Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php
                                if(isset($_SESSION["user_name"])){
                            echo $_SESSION['user_name'];
                                }
                               ?> 
                            </small>
                            
                             <small><?php
                                 if(isset($_SESSION["user_name"])){
                            echo  $_SESSION['user_time'];
                                 }
                        ?>  </small>
                        </h1>
                       <div class="col-xs-6">
                           <?php
                           if(isset($_POST["submit"])){
                               $cat_add=$_POST["cat_title"];
                               if($cat_add==""||empty($cat_add)){
                                   echo "This field cannot be blank";
                               }
                               else{
                               $query="insert into categories(cat_title) value('{$cat_add}') ";
                               $add_result=mysqli_query($connection,$query);
                               header("Location:categories.php");
                               if(!$add_result){
                                  die("query failed".mysqli_error($connection));
                               }
                               }
                           } 
                           ?>
                        <form action="" method="post">
                         <div class="form-group">
                        <label for="title">Category Title</label>
                        <input type="text" name="cat_title" class="form-control" id="title">     
                        </div> 
                        <div class="form-group">
                        <input type="submit" name="submit"  class="btn btn-primary" value="Add Category">     
                        </div> 
                        </form>
                        
                           
                         <form action="" method="post">
                         <div class="form-group">
                        <label for="title1"> Edit Category</label>
                        <!-- EDIT CATEGORIES FORM-->
                            <?php
                            if(isset($_GET["edit"])){
                                $cat_id=$_GET["edit"];
                                $query="select * from categories where cat_id=$cat_id";
                                $select_result=mysqli_query($connection,$query);
                                if(!$select_result){
                                    die("query failed".mysqli_error($connection));
                                }
                            while($row=mysqli_fetch_assoc($select_result)){
                            $cat_id=$row["cat_id"];
                            $cat_title=$row["cat_title"];
                                ?>
                              <input value="<?php echo $cat_title;  ?>"  type="text" name="cat_title" class="form-control" id="title1">
                                
                             <?php }} ?>  
                              <!-- UPDATING CATEGORIES-->
                             <?php
                             if(isset($_POST["update"])){
                                 $update_title=$_POST["cat_title"];
                                 $query="update categories set cat_title='{$update_title}' where cat_id=$cat_id";
                                 $update_result=mysqli_query($connection,$query);
                                 if(!$update_result){
                                     die("query failed".mysqli_error($connection));
                                 }
                             }
                             ?>
                        
                             </div> 
                        <div class="form-group">                
                        <input   type="submit" name="update"  class="btn btn-primary" value="Update Category">    
                        </div> 
                        </form>
                           
                           
                        </div>
                        <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                
                        <th>Category Title</th>    
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query="select * from categories";
                          $select_categories=mysqli_query($connection,$query);
                        while($row=mysqli_fetch_assoc($select_categories)){
                            $cat_id=$row["cat_id"];
                            $cat_title=$row["cat_title"];
                            echo "<tr>";
                        
                            echo "<td>$cat_title</td>";
                            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                            echo "</tr>";
                        }
                            ?>
                           <!-- DELETING CATEGORIES-->
                            <?php
                            if(isset($_GET["delete"])){
                                $delete_id=$_GET["delete"];
                                $query="delete from categories where cat_id={$delete_id}";
                                $delete_result=mysqli_query($connection,$query);
                                header("Location:categories.php");
                                if(!$delete_result){
                                    die("query failed".mysqli_error($connection));
                                }
                            }
                        ?>   
                        </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
     

</body>

</html>

