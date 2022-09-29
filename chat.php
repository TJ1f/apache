<?php

    session_start();

    if(!isset($_SESSION["nickname"])){
        header("location:index.php");
        die();
    }
    
    $nickname = $_SESSION["nickname"];
    $ip = $_SERVER["REMOTE_ADDR"];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <script src="script/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

    <script>
        $(document).ready(function() {
            $("#sendbutton").click(function() {
                sendMessage();
            });
            
            $("#message").keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    sendMessage();
                    return false;
                }
            });

            updateMessages();
            setInterval(function() {
                updateMessages();
            }, 1000);

            $("#message").focus();
        });

        function updateMessages() {
            $.get(
                "getmessages.php", 
                function(data) {
                    $("#chatcontainer").html(data);
                }  
            );
        }

        function sendMessage() {
            var message = $("#message").val();
            if(message.trim() != "") {
                $.post(
                    "sendmessage.php",
                    $("#messageform").serialize(),
                    function(data) {
                        updateMessages();
                });

                $("#message").val("");
                $("#message").focus();
            }
        }
       
    </script>
</head>
<body>
    <div class="container-fluid p-0">
        <div id="chatheader">
            <img src="images/logowhite.png" class='float-left mt-1 mr-3' style='width: 120px;' />
            <h4 class='float-left mt-3 ml-2'>Welkom in de chat: <strong><?php echo $nickname; ?></strong></h4>
            <a href="signout.php" onclick="return confirm('Weet je zeker dat je de chat wilt verlaten?');" class='float-right mt-3 mr-4 whitelink'>Chat verlaten</a>
            <span class='float-right mt-3 mr-5'>Server-IP: <strong><?php echo $ip; ?></strong></span>
            <div class='clear-fix'></div>
        </div>
        <div id="chatmessageheader" class='p-1 pl-2 ' style='background-color:#282a35;color:white;'><strong>Berichten</strong></div>
        
        
        <div id="chatcontainer" class='p-2'></div>
        <div id="composecontainer" class="fixed-bottom">
            <form id="messageform">
                <span>Bericht: </span><input name="message" type="text" id="message" style='width: 450px;'></input><button id="sendbutton" class='btn btn-sm btn-primary ml-3' type="button">Verzenden</button> 
            </form>
        </div>
    </div>
</body>
</html>