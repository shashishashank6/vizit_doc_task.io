
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CMS-login</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/bootstrap.min.css" rel="stylesheet">  

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
 <div class="jumbotron" style="margin-top:-65px">
      <div class="container">
          <h1>CMS</h1>
        <p>A content management system (CMS) is a computer application that supports the creation and modification of digital content. It is often used to support multiple users working in a collaborative environment.</p>
        <p><a class="btn btn-primary btn-lg" href="https://en.wikipedia.org/wiki/Content_management_system" role="button">Learn more &raquo;</a></p>
      </div>
    </div>
      
    <div class="container">

      <form class="form-signin" action="includes/login.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUser" class="sr-only">Email address</label>
        <input type="text" id="inputUser" class="form-control" placeholder="Enter Username" required autofocus name="username">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Enter Password" required name="password">
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
          
                        New to CMS? <a href="registration-form"> Register</a>
                    
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
