<?php
include("db.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $booksitetitle ?></title>
        <meta charset="utf-8">
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        
        <script src="jquery-3.6.4.min.js"></script>
        
        <style>
            body{
                background-color: black;
            }
            #container{
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                text-align: center;
            }
            .resize_fit_center {
                height: 100%;
                max-width:100%;
                max-height:100%;
                vertical-align: middle;
                
            }
        </style>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
    </head>
    
    <body>
        
        <?php
        if(isset($_GET["code"])){
            $code = mysqli_real_escape_string($connection, $_GET["code"]);
            $sql = "SELECT * FROM books WHERE uniqid = '$code'";
            $result = mysqli_query($connection, $sql);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div id='container'>
                        <img onclick="openbook('<?php echo $row["slug"] ?>')" class='resize_fit_center' src="upl/<?php echo $row["slug"] ?>.jpg" />
                    </div>
                    <?php
                }
            }
        }
        ?>
        
        <script>
            function openbook(slug){
                //alert(slug);
                $("body").append('<div id="myweb" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;"> <iframe src="pdfjs/web/viewer.html?file=<?php echo $baseurl ?>/upl/' +slug+ '.pdf#toolbar=0" width="100%" height="100%" title="Buku" style="border: none;"></iframe> </div>');
            }
        </script>
    </body>
    
</html>