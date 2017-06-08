
   function checkServer(){
    var ajaxRequest;
    var username = document.getElementById("username").value;
    console.log(username);
    if (window.XMLHttpRequest) {
        ajaxRequest = new XMLHttpRequest();
    } else {
        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP"); /// Older Browsers
    }
    ajaxRequest.onreadystatechange = function() {
        //console.log(ajaxrequest);
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            document.getElementById("result_1").innerHTML = ajaxRequest.responseText;
        }
    }
    ajaxRequest.open("POST", "check.php", true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send("usernamename=" + username);
    console.log(ajaxRequest);
       
        }
