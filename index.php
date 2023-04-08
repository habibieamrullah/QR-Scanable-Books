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
        <style>
            <?php include("style.php") ?>
        </style>
        
        <script src="jquery-3.6.4.min.js"></script>

    </head>
    
    <body>
        
        <?php echo $content ?>
        
        <?php echo $footer ?>
        
    </body>
    
</html>