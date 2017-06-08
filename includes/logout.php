
<?php include "db.php"; ?>
<?php session_start(); ?>
<?php
if(!isset($_SESSION["user_name"])){
    header("Location:./entry.php");
}
?>

<?php
if(isset($_GET["src"])){
$src=$_GET["src"];    
}
else{
    $source="";
}
switch($src){
        case "logout_page";
        include "logout_page.php";
}

$_SESSION["user_name"]=null;
session_destroy();
header("Location: ../entry.php");
?>