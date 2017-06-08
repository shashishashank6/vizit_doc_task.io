<?php include "../includes/db.php";?>
<?php include "functions.php";?>
<?php ob_start(); ?>
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
    

    <title>CMS Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
<!--    <meta http-equiv="refresh" content="1" />-->
    <!-- Custom Fonts -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
     /*  function hi(){
        
             var request=new XMLHttpRequest();
            request.open('GET','functions.php',true);
             request.onreadystatechange=function(){
             if(request.readyState==4 && request.status==200){
             document.getElementById('Online').innerHTML=request.responseText;
            }
        }
        
        request.send();
            console.log(request);
    }
        hi();
    
    
        setInterval(function(){
           hi(); 
        },500);*/
        </script>
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
                <a class="navbar-brand active" href="index.php">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                
                
                <?php
                   if(isset($_SESSION["user_name"])){
                        ?>
                    <li><a href=''>Users Online: <span id="Online"> </span></a></li>;
                <?php
                    }
                    ?>
                
                
                <li><a href="../index">HOME SITE</a></li>
                
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
                    
                    <li>
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
                    <li>
                         <a href="chat.php"><i class="glyphicon glyphicon-user" aria-hidden="true"></i> chat</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            
            
           <?php
        
    
                 //  function online(){
                      /* global $connection;
                   $session=session_id();
            $time=time();
            $time_out_in_seconds=30;
            $time_out=$time-$time_out_in_seconds;
            $query="select * from users_online where session='$session'";
            $send_query=mysqli_query($connection,$query);
            $count=mysqli_num_rows($send_query);
            if($count==null){
                mysqli_query($connection,"insert into users_online(session,time) values('$session','$time')");
            }
            else{
                   mysqli_query($connection,"update  users_online set time='$time' where session='$session'");
                
            }
           $users_online_query= mysqli_query($connection,"select * from users_online where time>'$time_out'");
                  
       return  $count_users=mysqli_num_rows($users_online_query);
            */          
            ?>
                
                       <?php
           // }
                
            
            ?> 
            
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
                               ?></small>
                            
                             <small><?php
                                 if(isset($_SESSION["user_name"])){
                            echo  $_SESSION['user_time'];
                                 }
                        ?>  </small>
                            
                        </h1>
                        
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               
                <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        $query="select * from posts";
                        $select_post=mysqli_query($connection,$query);
                        $post_count=mysqli_num_rows($select_post);
                        echo "<div class='huge'>{$post_count}</div>";
                        ?>
                        
                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                         <?php
                        $query="select * from comments";
                        $select_comments=mysqli_query($connection,$query);
                        $comment_count=mysqli_num_rows($select_comments);
                        echo "<div class='huge'>{$comment_count}</div>";
                        ?>
                    
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                         <?php
                        $query="select * from users";
                        $select_users=mysqli_query($connection,$query);
                        $users_count=mysqli_num_rows($select_users);
                        echo "<div class='huge'>{$users_count}</div>";
                        ?>
                    
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                         <?php
                        $query="select * from categories";
                        $select_categories=mysqli_query($connection,$query);
                        $category_count=mysqli_num_rows($select_categories);
                        echo "<div class='huge'>{$category_count}</div>";
                        ?>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <?php
                        $query="select * from posts where post_status='draft' ";
                        $select_count_post_draft=mysqli_query($connection,$query);
                        $post_count_draft=mysqli_num_rows($select_count_post_draft);
                
                        $query="select * from comments where comment_status='unapproved' ";
                        $select_count_comments_unapproved=mysqli_query($connection,$query);
                        $comment_count_unapproved=mysqli_num_rows($select_count_comments_unapproved);
                        
                        
                        $query="select * from users where user_role='subscriber' ";
                        $select_count_subscribers=mysqli_query($connection,$query);
                        $subscribers_count=mysqli_num_rows($select_count_subscribers);
                ?>
                <div class="row">
                    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            
         <?php
        $element_text=['Active Posts','Draft Posts','Comments','Pending Comments','Users','subscribers','Categories'];
        $element_count=[$post_count,$post_count_draft,$comment_count,$comment_count_unapproved,$users_count,$subscribers_count,$category_count,];
         for($i=0;$i<6;$i++){
             echo "['{$element_text[$i]}'".","."{$element_count[$i]}],";
         }
        ?>    
//          ['2017', 1030, 540, 350],
        ]);
          
          
        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>

</body>

</html>
