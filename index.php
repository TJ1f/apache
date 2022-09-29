<?php

$error = null;

if (isset($_POST["login"]) && isset($_POST["color"])) {
    $nickname = htmlentities(trim($_POST["login"]));

    if ($nickname == "") {
        $error = "Vul een waarde in bij chatnaam";
    } else {
        $color = trim($_POST["color"]);

        if($color == "") {
            $error = "Selecteer een kleur";
        }
        else {
            session_start();

            $_SESSION["nickname"] = $nickname;
            $_SESSION["color"] = $color;
            header("location: chat.php");
        }
    }
}

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
        $(window).ready(function() {
            $("#login").focus();

            $("#colorselect").change(function() {
                $("#colorselect").css("color", $("#colorselect").val());
            });
        });
    </script>
</head>

<body id="page-top">
    <div class="container-fluid p-0 m-0">
        <div class="container-fluid">
            <div class="card card-login mx-auto mt-5">
                <div class="card-header">
                    <img class="img-fluid rounded" src="../images/logo2.png" />
                </div>
                <div class="card-body">
                    <?php
                    if (isset($error)) { ?>
                        <div class="container-fluid mb-3 p-1 bg-danger rounded">
                            <img src="../images/error.png?v=1" class="float-left m-0 ml-2 mr-3">
                            <p class="m-0 text-white small"><?php echo $error; ?></p>
                        </div>
                    <?php } ?>

                    <form method="post">
                        <div class="form-group">
                            <label for="login">Jouw chatnaam</label>
                            <input class="form-control" name="login" id="login" type="text" placeholder="Jouw naam tijdens de chat" maxlength="50" value="">
                        </div>

                        <div class="form-group mb-4">
                            <label for="exampleFormControlSelect1">Jouw tekstkleur</label>
                            <select class="form-control" id="colorselect" name="color" style='color:red;font-weight:bold;'>
                                <option value='red' style='background-color:#ededed;color:red;font-weight:bold;'>Rood</option>
                                <option value='blue' style='background-color:#ededed;color:blue;font-weight:bold;'>Blauw</option>
                                <option value='green' style='background-color:#ededed;color:green;font-weight:bold;'>Groen</option>
                                <option value='orange' style='background-color:#ededed;color:orange;font-weight:bold;'>Oranje</option>
                                <option value='purple' style='background-color:#ededed;color:purple;font-weight:bold;'>Paars</option>
                                <option value='pink' style='background-color:#ededed;color:pink;font-weight:bold;'>Roze</option>
                                <option value='#e8d317' style='background-color:#ededed;color:#e8d317;font-weight:bold;'>Geel</option>
                                <option value='black' style='background-color:#ededed;color:black;font-weight:bold;'>Zwart</option>
                                <option value='brown' style='background-color:#ededed;  color:brown;font-weight:bold;'>Bruin</option>
                            </select>
                        </div>

                        <input type="submit" class="btn btn-primary btn-block mb-3" value="Deelnemen aan chat">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>