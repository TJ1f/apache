<?php
    $messages = json_decode(file_get_contents("data.json"));    
    $output = "";

    for($i = count($messages) -1; $i >= 0; $i --) {
        $message = $messages[$i];
        $output .= "<span><strong> $message->date</strong><span> $message->user: </span><span style='color:$message->color;'>$message->message</span></span><br/>";
    }

    echo rtrim($output, "<br/>");

?>