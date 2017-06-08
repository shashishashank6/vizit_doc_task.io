<?php ob_start();?>
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
                                if(isset($_SESSION['user_name'])){
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
                    <li>
                        <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    <li>
                        <a href="comments.php"><i class="fa fa-fw fa-file"></i> Comments</a>
                    </li>
                     <li class="active">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="users.php">View All Users</a>
                            </li>
                            
                        </ul>
                    </li>
                     <li>
                         <a class="active" href="profile.php"><i class="fa fa-fw fa-dashboard"></i>Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        
        <?php
        if(isset($_SESSION["user_name"])){
            $username=$_SESSION["user_name"];
            $query="select * from users where user_name='{$username}'";
            $select_user_profile=mysqli_query($connection,$query);
            if(!$select_user_profile){
                die("query failed".mysqli_error($connection));
            }
            while($row=mysqli_fetch_array($select_user_profile)){
                         $user_id=$row["user_id"];
                         $user_name=$row["user_name"];
                         $user_password=$row["user_password"];
                         $user_firstname=$row["user_firstname"];
                         $user_lastname=$row["user_lastname"];
                         $user_email=$row["user_email"];
                         $user_role=$row["user_role"]; 
            }
        }
        ?>
        <?php
        if(isset($_SESSION["user_name"])){
            ?>
        <?php
        if(isset($_POST["update_user"])){
                               $user_firstname=$_POST["user_firstname"];
                               $user_lastname=$_POST["user_lastname"];
                               $user_role=$_POST["user_role"];
                               $user_name=$_POST["user_name"];
                               $user_email=$_POST["user_email"];
                               $user_password=$_POST["user_password"];
                              
                              
                              $query = "UPDATE users SET ";
                              $query .="user_firstname  = '{$user_firstname}', ";
                              $query .="user_lastname = '{$user_lastname}', ";
                              $query .="user_role   =  '{$user_role}', ";
                              $query .="user_name = '{$user_name}', ";
                              $query .="user_email = '{$user_email}', ";
                              $query .="user_password   = '{$user_password}' ";
                              $query .= "WHERE user_name = '{$username}' ";
       
                              $edit_user_query=mysqli_query($connection,$query);
                              if(!$edit_user_query){
                                  die("query failed".mysqli_error($connection));
                              }
                       echo "<p class='bg-success'>Profile Updated</p>";
                          }
        
        ?>
        <?php } ?>
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome to admin
                            <small><?php
                                if(isset($_SESSION['user_name'])){
                            echo $_SESSION['user_name'];
                                }
                               ?></small>
                        
                         <small><?php
                             if(isset($_SESSION['user_time'])){
                            echo  $_SESSION['user_time'];
                             }
                        ?>  </small>
                        
                        </h1>
                        
                        <?php
                        if(isset($_SESSION['user_name'])){
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
        <option value="subscriber"><?php echo $user_role; ?></option>
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
          <input class="btn btn-primary" type="submit" name="update_user" value="Update Profile">
      </div>


</form>
    
        <?php } ?>
                        
                        
                        
                        
                        
                       
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
