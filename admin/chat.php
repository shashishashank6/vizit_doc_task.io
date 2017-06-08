<?php
include "../includes/db.php";
?>
<?php
include "../includes/functions.php";
?>
<?php
session_start();
?>

<?php
if(!isset($_SESSION["user_name"])){
        header("Location:../entry.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{
            background: #fff;
        }
        #chat_box{
            width: 90%;
            
            height: 400px;
        }
        /*input[type="text"]{
            width: 60%;
            height: 40px;
            border: 1px solid gray;
            border-radius: 5px;
        }
      
        textarea{
             width: 60%;
            height: 40px;
            border: 1px solid gray;
            border-radius: 5px;
        }
        input[type="submit"]{
            width: 60%;
            height: 40px;
            border: 1px solid gray;
            border-radius: 5px;
        }*/
        #chat_box{
           width: 100%;
            padding: 5px;
            margin-top: 55px!important;
            margin-top: 15px;
            font-weight: bold;
        }
        @media(max-width:520px){
            #chat_box{
                width: 100%;
                transform: translateY(70%);
            }
        }
        
       
    </style>
    <script>
    function ajax(){
        var request=new XMLHttpRequest();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                document.getElementById('chat').innerHTML=request.responseText;
            }
        }
        request.open('GET','chat_1.php',true);
        request.send();
    }
    
    
        setInterval(function(){
           ajax(); 
        },500);
    </script>
</head>
<body onload="ajax();">
    <a class="navbar-brand active" href="index.php">CMS Admin</a>
<div class="container">
    <div class="row">
        <div class="col-md-6 chat-section">
    <div id="chat_box">
   <div id="chat"></div>
       
    
    </div>
        </div>
<?php
    if(isset($_POST["submit"])){
        $name=$_POST["name"];
        $message=$_POST["enter_message"];
$query="insert into chat (chat_user_name,chat_message) values('{$name}','{$message}')";
        $insert=mysqli_query($connection,$query);
         if(!$insert){
        die("query failed".mysqli_error($connection));
    }
        
        
    }
    ?>
 <?php
        if(isset($_SESSION["user_name"])){
  if(isset($_GET["chat_id"])){
      $chat_id=mysqli_real_escape_string($connection,$_GET["chat_id"]);
      $query="delete from chat where chat_id=$chat_id";
      $delete=mysqli_query($connection,$query);
      if(!$delete){
          die("query failed".mysqli_error($connection));
      }
      header("Location:chat.php");
  }  
        }
  ?>
        <style>
            form{
                margin-top: 50px;
            }
        </style>
    <div class="pull-right">
        <div class="col-md-12">
    <form action="" method="post" class="pull-right inline">
        <div class="form-group">
    <input type="text" name="name" placeholder="enter name" class="form-control">
        </div>
        <div class="form-group">
    <textarea name="enter_message" placeholder="enter message" class="form-control"></textarea>
        </div>
    <input type="submit" name="submit" value="Send" class="btn btn-default">
    </form>
        </div>
    </div>
    </div>
    <!-- 
<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputName2">Name</label>
    <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
  </div>
  <button type="submit" class="btn btn-default">Send invitation</button>
</form>


-->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>