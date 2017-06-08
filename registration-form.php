<?php
include "includes/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS-Registration</title>

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
    
    
<?php
$msg="";
$message="";
$message1="";
$message2="";
if(isset($_POST["submit"])){
            $username=strtolower($_POST["username"]);
            $email=$_POST["email"];
            $password=$_POST["password"];
    
            $query0="select user_name from users where user_name='{$username}'";
            $check=mysqli_query($connection,$query0);
            if(!$check){
                die("query failed".mysqli_error($connection));
            }
            $check_name="";
            while($row=mysqli_fetch_array($check)){
                 $check_name=$row["user_name"];
            }
    
    
                 $Allusers = array($check_name);
    
    
                 if(!preg_match('/^[a-zA-Z0-9_]{5,}$/', $username)) { // for english chars + numbers only
    // valid username, alphanumeric & longer than or equals 5 chars
                                     $msg="user name must be greater than or equal to 5 characters,alphanumeric or all alphabets and also may contain Underscore special character and there must be no blank space in bewteen the letters/characters ";
                            
}
     elseif(!preg_match('/^(?=.*\d)[a-zA-Z0-9 ]{5,}$/', $password)){
                     $message1="weak password,password must be atleast 6 characters long,no special characters,there may be a blank space and must need atleast one number";
                 }
    elseif(in_array($username,$Allusers)){
        $message2="user name has already been taken";
    }
     else{
              
            $username=mysqli_real_escape_string($connection,$username);
            $email=mysqli_real_escape_string($connection,$email);
            $password=mysqli_real_escape_string($connection,$password);
    
           $query="select randsalt from users";
           $query_randsalt=mysqli_query($connection,$query);
           if(!$query_randsalt){
               die("query failed".mysqli_error($connection));
           }
         $message="your registraion has been completed";
           $row=mysqli_fetch_array($query_randsalt);
                $salt=$row["randsalt"];
           $password=crypt($password,$salt);
          
            $query1="insert into users (user_name,user_password,user_email,join_date) values('{$username}','{$password}','{$email}',now()) ";
            $register_details=mysqli_query($connection,$query1);
            if(!$register_details){
               die("query failed".mysqli_error($connection));
           }
                 
    
     }
   
}
    
    
?>
    
    
<div class="container">
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <?php 
                        if(isset($_POST["submit"])){
                            ?>
                        <h6><?php echo $message; ?></h6>
                        <?php
                        } 
                        ?>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text"  name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                       <?php
                            if(isset($_POST["submit"])){
                                $username=$_POST["username"];
                                ?>
                                <div class="bg-danger"><?php echo $msg; ?></div>
                            <?php
                                   }
                                   
                            
                            ?>
                          
                                
                            
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                             <style>
                                 .form-control-note{
                                     font-size: 12px;
                                 }
                             </style>
                             <p class="form-control-note">Use at least one letter, one numeral,no special characters,there may be a blank space and 6 characters.</p>
                              <?php
                            if(isset($_POST["submit"])){
                                $username=$_POST["password"];
                                ?>
                             <div class="bg-danger"><?php echo $message1; ?></div>
                               
                            <?php
                                   }
                                   ?>
                            
                        
                        </div>
                        <?php
                        if(isset($_POST["submit"])){
                                $username=$_POST["password"];
                                ?>
                         <div class="bg-danger"><?php echo $message2; ?></div>
                        <br>       
                         
                        <?php
                                   }
                                   ?>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register" onkeyup="checkServer()" onclick="checkServer()">
                    </form>
                    <a href="entry.php"> Login?</a> if u have already an account
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
    
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
<!--    <script src="js/name.js" type="application/javascript"></script>-->
    
    

</body>

</html>
