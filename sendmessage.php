<?php
    date_default_timezone_set("Europe/Amsterdam");

    session_start();

    if(!isset($_SESSION["nickname"])) {
        echo "Niet aangemeld!";
        exit();
    }


    if($_POST) {
        $message = new stdClass();
        $message->date = date("d-m-Y H:i:s");
        $message->message = htmlentities($_POST["message"]);
        $message->user = $_SESSION["nickname"];
        $message->color = $_SESSION["color"];

        $messages = json_decode(file_get_contents("data.json"));
        array_push($messages, $message);

        file_put_contents("data.json", json_encode($messages, JSON_PRETTY_PRINT));
    }   

?>