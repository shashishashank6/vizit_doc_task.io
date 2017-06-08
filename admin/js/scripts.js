$(document).ready(function(){
   $("#selectAllBoxes").click(function(event){
       if(this.checked){
           $(".checkBoxes").each(function(){
              this.checked=true; 
           });
       }
       else{
           $(".checkBoxes").each(function(){
          this.checked=false;
           });
       }
                                 
   });
});

function loadUsersOnline(){
    $.get("functions.php?onlineUsers=result",function(data){
        $("#Online").text(data);
    });
}
setInterval(function(){
    loadUsersOnline();
},500);
loadUsersOnline();