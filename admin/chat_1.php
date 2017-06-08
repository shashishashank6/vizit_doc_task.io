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
<style>
    @media(max-width:520px){
    #chat_data{
        width: 100%;
    }
        form{
            width: 100%;
            text-align: center;
            transform: translate(-70%,-260%);
        }
    }
</style>
<?php
    $query="select * from chat";
    $chat=mysqli_query($connection,$query);
    if(!$chat){
        die("query failed".mysqli_error($connection));
    }
    while($row=mysqli_fetch_array($chat)){
        ?>
         <div id="chat_data">
        <span style="color:green;"><?php echo $row["chat_user_name"]; ?>:</span> 
        <span style="color:brown;"><?php echo $row["chat_message"]; ?></span> 
        <span style="float:right;"><?php echo $row["chat_date"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="chat.php?chat_id=<?php echo escape($row["chat_id"]); ?>" >delete</a></span> 

             <style>
                 a{
                     cursor: pointer;
                 }
            }
             </style>
        


        </div>

<div>
</div>
        <?php
    }
        ?>
    