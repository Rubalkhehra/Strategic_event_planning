<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>result</title>
    <script src="JS/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="JS/bootstrap.js" type="text/javascript"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        body {
            background-image: url(pics/flowers.jpg);
            background-size: cover;

        }

        a {
            text-decoration: none;
            font-size: 20px;
            color: blue;
        }

    </style>

</head>

<body>

    <h1>
        <?php
    echo"<center style='margin-top:40px ;
            color: darkred;'>".$_GET["msg"]."</center>";
    ?>

        <hr>
<!--        <center> <a href="<?php  echo $_SERVER['HTTP_REFERER']; ?>"> GO BACK</a></center>-->
        <center> <a href=contributor-dashboard.php> GO BACK</a></center>


    </h1>


</body>

</html>
