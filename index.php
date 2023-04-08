<?php
include("content.php");
?>

<!DOCTYPE html>
<html>
    <head>
        
        <title><?php echo $title ?></title>
        
        <meta charset="utf-8">
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400&display=swap" rel="stylesheet">
        
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        
        <style>
            <?php include("style.php") ?>
        </style>
        
        <script src="jquery-3.6.4.min.js"></script>
        
    </head>
    
    <body>
        
        <div class="wrapper">
            <?php echo $content ?>
        </div>
        
        <?php echo $footer ?>
        
    </body>
    
</html>